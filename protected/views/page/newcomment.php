

<?php
/* @var $this CmsCommentController */
/* @var $model CmsComment */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile('http://web/js/viewcom.js');

?>

<div class="raw" id="NewComFormId" role="form">
    <?php
         $form=$this->beginWidget('CActiveForm', array(
            'id'=>'cms-comment-form',
            'enableAjaxValidation'=>false,
             'htmlOptions'=>array('class'=>'form-inline'),
            ));
         echo $form->errorSummary($model);
         if(Yii::app()->user->isGuest):
    ?>

    <div class="col-md-5 form-group">
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
            <?php echo $form->textField($model,'guest',array('size'=>60,'maxlength'=>255, 'class'=>'form-control', 'id'=>'guest')); ?>
        </div>
   </div>

    <div class="col-md-7 form-group">
        <?php echo $form->textArea($model,'content',array('rows'=>5, 'cols'=>40,'id'=>'content1', 'class'=>'form-control')); ?>
    </div>

         <?endif;?>
        <?if(!Yii::app()->user->isGuest):?>
            <div class="form-group">
                <?php echo $form->textArea($model,'content',array('rows'=>5,'id'=>'contentUser', 'class'=>'form-control')); ?>
            </div>
        <?endif;?>
    <br>
    <br>
    <div class="row text-center">
        <? echo CHtml::hiddenField('guest','',array('id'=>'GuestOrUser','value'=>Yii::app()->user->isGuest))?>
        <?php echo $form->hiddenField($model,'parent_id',array('id'=>'parent')); ?>
        <?php echo CHtml::submitButton('Отправить',array('class'=>'btn btn-danger','id'=>'newCom')); ?>
    </div>
    <br>
    <br><br>
    <br>
    <?php $this->endWidget(); ?>
</div>

