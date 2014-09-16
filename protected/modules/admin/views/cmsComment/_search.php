<?php
/* @var $this CmsCommentController */
/* @var $model CmsComment */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array(""=>"",0=>"Скрыто",1=>"Опубликовано")); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'page_id'); ?>
		<?php echo $form->dropDownList($model,'page_id',CmsPage::all(),array('empty'=>'')); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id',CmsUser::all(),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest'); ?>
		<?php echo $form->textField($model,'guest',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->