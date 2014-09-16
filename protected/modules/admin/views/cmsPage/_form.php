<?php
/* @var $this CmsPageController */
/* @var $model CmsPage */
/* @var $form CActiveForm */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cms-page-form',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),

    // Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php
        if(!$model->isNewRecord)
        {echo  CmsSetting::car_image($model->path_img,200,150,'img-thumbnail','./images/pages/');
        echo "<br>";
        echo "<br>";
        }
        echo $form->fileField($model,'image');


        ?>
        <?php echo $form->error($model,'image'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php $this->widget('application.extensions.ckeditor.CKEditor', array( 'model' => $model, 'attribute'=>'content', 'language'=>'ru', 'editorTemplate'=>'full' )); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(2=>"Опубликовать",3=>"Снять с пуб")); ?>


        <?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',CmsCategory::all()); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->