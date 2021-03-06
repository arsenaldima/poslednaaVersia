<?php
/* @var $this UserPersonalController */
/* @var $model CmsUser */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile('http://web/js/CheckEmail.js');
?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="bg-success well well-lg text-center">
        <h4><?php echo Yii::app()->user->getFlash('success'); ?></h4>
    </div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="bg-warning well well-lg">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<br>

<div class="row-fluid">
    <div class="col-md-6 container-fluid">
        <? if(!Yii::app()->user->hasFlash('error')&&!Yii::app()->user->hasFlash('success')):?>
        <? echo CHtml::form('','POST',array('role'=>'form'));?>

            <div class="form-group">
                <label for="text">Email address</label>
                <?php echo CHtml::textField('email','',array('id'=>'text','placeholder'=>'Enter email','class'=>'form-control','type'=>'email'));?>

            </div>

        <?
            echo CHtml::submitButton('Отправить',array('class'=>'btn btn-primary', 'id'=>'sub'));
            echo CHtml::endForm();
            endif;
        ?>
    </div>
</div>