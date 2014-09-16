<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register();
    Yii::app()->clientScript->registerCssFile('http://web/css/page.css');
    Yii::app()->clientScript->registerCssFile('http://web/css/font-awesome.css');
    Yii::app()->clientScript->registerCssFile('http://web/css/style.css');
    Yii::app()->clientScript->registerScriptFile('http://web/js/page.js');
    $brouzer=CmsSetting::user_browser($_SERVER['HTTP_USER_AGENT']);

    if(($brouzer!='Opera')&&($brouzer!='Chrome'))
    {
        Yii::app()->clientScript->registerScriptFile('http://web/js/jquery.tools.min.js');
    }
    ?>

</head>


<body>


<div class="container">
    <div class="col-md-offset-2">

    </div>
    <div class="col-md-10">
        <div class="container">
            <div class="row">
                <div class="nav navbar-default verxmenu">
                    <div class="container">

                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?echo Yii::app()->homeUrl?>"><? echo Yii::app()->name?><span class="blok"></span></a>

                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu"></button>
                        </div>


                        <div class="collapse navbar-collapse" id="responsive-menu">



                            <ul class="nav nav-pills">

                                <li class="dd"><a href="/site/index">Home</a></li>
                                <?if(Yii::app()->user->checkAccess('3')||Yii::app()->user->checkAccess('2'))
                                {

                                    echo CHtml::openTag('li',array('class'=>'dd'));
                                    echo  CHtml::link('Admin Panel','/admin/default/index');
                                    echo"</li>";
                                }
                                ?>

                                <?
                                if(Yii::app()->user->isGuest)
                                {
                                    echo CHtml::openTag('li',array('class'=>'dd'));
                                    echo  CHtml::link('Регистрация',array('/site/registration','id'=>0));
                                    echo"</li>";
                                }
                                ?>

                                <?
                                if(Yii::app()->user->isGuest)
                                {
                                    echo CHtml::openTag('li',array('class'=>'dd'));
                                    echo  CHtml::link('Авторизация',array('/site/login'));
                                    echo"</li>";
                                }
                                ?>

                                <?
                                if(!Yii::app()->user->isGuest)
                                {
                                    echo CHtml::openTag('li',array('class'=>'dd'));
                                    echo  CHtml::link(Yii::app()->user->name ,array('/userPersonal/index','id'=>Yii::app()->user->id));
                                    echo"</li>";
                                }
                                ?>

                            </ul>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<div class="container" id="page">




	<?php echo $content; ?>





</div><!-- page -->

</body>
</html>
