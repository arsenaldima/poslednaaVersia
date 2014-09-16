<?php

class SettingController extends Controller
{
	public function actionIndex()
	{
        $model=new CmsSetting;

        if(isset($_POST['CmsSetting']))
        {
            $model->attributes=$_POST['CmsSetting'];
            $flag=CmsSetting::model()->updateByPk(1,array('ct_page'=>$model->ct_page,'time'=>$model->time,'podtv_email'=>$model->podtv_email, 'poblicazia_com'=>$model->poblicazia_com, 'publicazia_stat'=>$model->publicazia_stat, 'gost_com'=>$model->gost_com ));
        }



        $model=CmsSetting::model()->findByPk(1);
		$this->render('index',array('model'=>$model));
	}


    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index'),
                'roles'=>array('3'),
            ),

            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index'),
                'roles'=>array('2'),
            ),

            array('deny',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index'),
                'roles'=>array('1'),
            ),

            array('deny',  // deny all users
                'actions'=>array('index'),
                'users'=>array('?'),
            ),
        );
    }


    public function index()
    {

        $this->render('index');
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}