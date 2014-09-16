<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>
    <? if (isset($flag)):?>
        <div class="well well-lg text-center">

            <p class="text-info">
                <h2>Что б авторизироваться перейдите по ссылке указаном в email </h2>
            </p>
        </div>
    <? endif; ?>

<? if (!isset($flag)):?>
    <div class="text-center">
        <h1>Авторизация</h1>
        <hr/>
    </div>



    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center">

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'login-form',
            'type'=>'horizontal',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
            <?if(!$form->errorSummary($model,null, null,array('class'=>'text-warning er'))):?>
                <div class="well well-lg text-center">
                    <p class="text-warning"><?php echo $form->errorSummary($model,null, null,array('class'=>'text-warning er')); ?></p>
                </div>
            <? endif; ?>
                <?php echo $form->textFieldRow($model,'username',array('class'=>'form-control')); ?>

                <?php echo $form->passwordFieldRow($model,'password',array('class'=>'form-control')); ?>
                <br>
                <br>

                <div class="form-actions">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'primary',
                        'label'=>'Авторизироватся',
                    )); ?>
                </div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    <div class="col-md-4"></div>
</div>

<div class="row text-center" style="margin-top: 5%">
    <h5>Вы имеете акаунт в соц. сетях? Кликните на иконку для авторизации:</h5>
    <?php Yii::app()->eauth->renderWidget(); ?>
    <? endif ?>
</div>