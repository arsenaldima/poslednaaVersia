<?php

class CmsPageController extends Controller
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                  'actions'=>array('delete','index','update'),
                  'roles'=>array('3'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('delete','index','update'),
                'roles'=>array('2'),
            ),

            array('deny',  // deny all users
                  'actions'=>array('delete','index','update'),
                  'roles'=>array('1'),
            ),

            array('deny',  // deny all users
                'actions'=>array('delete','index','update'),
                'roles'=>array('?'),
            ),
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['CmsPage']))
        {
            if($model->validate())
            {
                $model->attributes=$_POST['CmsPage'];
                $image=CUploadedFile::getInstance($model,'image');
                $model->image=$image;
                $rand=uniqid();
                $model->image->saveAs('c:/WebServers/home/localhost/www/web_test/images/pages/'.$rand.$model->image->name);
                $model->path_img = $model->image->name;
                CmsPage::model()->updateByPk($id,array('path_img'=>$rand.$model->image->getName(),'content'=>$model->content, 'title'=>$model->title));

            }
            $this->redirect(array('index'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('Index'));
	}

	/**
	 * Lists all models.
	 */

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        if(isset($_POST['opyblic']))
        {
            CmsPage::model()->updateByPk($_POST['page_id'],array('status'=>2));
        }

        if(isset($_POST['del']))
        {
            CmsPage::model()->updateByPk($_POST['page_id'],array('status'=>3));
        }

		$model=new CmsPage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CmsPage']))
			$model->attributes=$_GET['CmsPage'];

		$this->render('Index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CmsPage the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CmsPage::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CmsPage $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cms-page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
