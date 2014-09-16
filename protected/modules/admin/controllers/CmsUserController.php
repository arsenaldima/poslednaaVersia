<?php

class CmsUserController extends Controller
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
                'actions'=>array('delete','index','update','view'),
                'roles'=>array('3'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('update','view'),
                'roles'=>array('2'),
            ),
            array('deny', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('delete','index','update','view'),
                'roles'=>array('1'),
            ),
            array('deny',  // deny all users
                'actions'=>array('delete','index','update','view'),
                'roles'=>array('?'),
            ),
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}



    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */


	/**
	 * Lists all models.
	 */


	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $mod=CmsUser::model()->findByPk($_POST['user_id']);

        if(isset($_POST['noban']))
        {

            if(($mod->role==1)||(($mod->role==1)&&(Yii::app()->user->id==3)))
                 CmsUser::model()->updateByPk($_POST['user_id'],array('ban'=>0));
            else
                 Yii::app()->user->setFlash('error','У вас недостаточно прав');

        }
        elseif(isset($_POST['ban']))
        {
            if(($mod->role==1)||(($mod->role==1)&&(Yii::app()->user->id==3)))
                  CmsUser::model()->updateByPk($_POST['user_id'],array('ban'=>1));
            else
                Yii::app()->user->setFlash('error','У вас недостаточно прав');
        }



        if(isset($_POST['mod']))
        {

            if($mod->role==1)
                CmsUser::model()->updateByPk($_POST['user_id'],array('role'=>2));
            else
                Yii::app()->user->setFlash('error','Пользователь уже являеться модератором');

        }
        elseif(isset($_POST['no_mod']))
        {
            if($mod->role==2)
                CmsUser::model()->updateByPk($_POST['user_id'],array('role'=>1));

        }


		$model=new CmsUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CmsUser']))
			$model->attributes=$_GET['CmsUser'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CmsUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CmsUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CmsUser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cms-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
