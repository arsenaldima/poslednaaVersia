<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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

            array('deny',  // deny all users
                'actions'=>array('index'),
                'roles'=>array('1'),
            ),

            array('deny',  // deny all users
                'actions'=>array('index'),
                'roles'=>array('?'),
            ),
        );
    }
}