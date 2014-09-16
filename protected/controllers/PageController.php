<?php

class PageController extends Controller
{


	public function actionIndex($id)
	{


        $this->processPageRequest('page');
        if($dataStr=Yii::app()->request->getParam('data'))
        {

            if(!empty($dataStr))
            {
                if($id==null)
                    $id=1;

                $data=strtotime($dataStr);
                $criteria= new CDbCriteria;
                $criteria->condition = 'category_id =:id AND status=2 AND DATE_FORMAT(FROM_UNIXTIME(created), "%Y%m%d")=:data';
                $criteria->params=array(':data'=>date('Ymd',$data),':id'=>$id);
                $model=CmsSetting::model()->findByPk(1);
                $prow= new CActiveDataProvider('CmsPage',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>$model->ct_page,'pageVar' =>'page')));

            }
        }
        else
        {
            $category= CmsCategory::model()->findByPk($id);
            $criteria= new CDbCriteria;
            $criteria->condition = 'status = 2 AND category_id =:id AND '.'created < :time';
            $criteria->params=array(':id'=>$id,':time'=>time());
            $criteria->order='created DESC';
            $model=CmsSetting::model()->findByPk(1);
            $prow= new CActiveDataProvider('CmsPage',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>$model->ct_page,'pageVar' =>'page'),));
        }
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('widget_ajax', array(
                'category'=>$category,
                'data'=>$prow,

            ));
            Yii::app()->end();
        } else {
            $this->render('index', array(
                'category'=>$category,
                'data'=>$prow,
                'val'=>$dataStr,
            ));
        }
	}

    public function actionView($id)
    {
        $model= CmsPage::model()->findByPk($id);
        $model1 = new CmsComment();
        $ar=$model1->getCommentsTree($id);

        if(isset($_POST['CmsComment']))
        {
            $model1->page_id=$id;

            if(!Yii::app()->user->isGuest)
                $model1->user_id=Yii::app()->user->id;// esli polzovatel ne gost tokda soxranaem ego id

            $model1->attributes=$_POST['CmsComment'];

            if($model1->save())
            {
                if(($model1->parent_id!=null)&&(!Yii::app()->user->isGuest))
                {
                    CmsComment::sendOtvet($model1->parent_id);
                }
            $this->refresh();
            }
        }

        if(Yii::app()->user->isGuest)
            $model1->scenario='ComSet';

        $this->render('view',array('model1'=> $model1,'model'=> $model,'comments'=>$ar));
    }

public function actionDelete($id)
{
    $model=CmsComment::model()->findByPk($id);

    if(Yii::app()->user->id==$model->user_id)
        if(CmsComment::model()->deleteByPk($id))
            $this->redirect(array('/page/view','id'=>$model->page_id));

}



    protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
    }



}