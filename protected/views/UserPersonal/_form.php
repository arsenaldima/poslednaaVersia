<?php
/* @var $this CmsPageController */
/* @var $model CmsPage */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile('http://web/js/createPage.js');
?>
<style type="text/css">

    #InputField{
        display: none;
    }
</style>


<div class="row">



    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'cms-page-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data','role'=>"form"),
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="well well-lg text-center">
        <p class="text-info">Поля с <span class="required">*</span> обязательный.</p>
        <p class="text-warning"><?php echo $form->errorSummary($model,null, null,array('class'=>'text-warning er')); ?></p>
    </div>

    <div class="col-md-4 container-fluid">
        <div class="form-group">

            <label for="InputTitel"><?echo $form->labelEx($model,'title');?></label>
            <?php echo $form->textField($model,'title',array('class'=>'form-control','id'=>'InputTitel')); ?>

        </div>
        <div class="form-group">
            <label ><?php echo $form->labelEx($model,'created'); ?></label>
            <input type="date" name="data" id="data" class="form-control">

        </div>
        <div class="form-group">
            <label ><?php echo $form->labelEx($model,'status'); ?></label>
            <?php echo $form->dropDownList($model,'status',array(0=>"Черновик",1=>"На модерацию"),array('class'=>'form-control')); ?>
        </div>
        <div class="form-group">
            <label ><?php echo $form->labelEx($model,'category_id'); ?></label>
            <?php echo $form->dropDownList($model,'category_id',CmsCategory::all(),array('class'=>'form-control')); ?>

        </div>
        <div class="form-group">
            <?php if(CmsPage::model()->isNewRecord):?>
                <?echo CmsSetting::carimage('',200,150,'img-thumbnail ImgDef',1,$model->user_id);?>
            <? endif;
            if(!CmsPage::model()->isNewRecord):
                ?>
                <?echo CmsSetting::carimage($model->path_img,200,150,'img-thumbnail ImgDef',1,$model->user_id);?>

            <?endif;?>

            <br>
            <br>

            <?php echo $form->fileField($model,'image',array('id'=>'InputField')); ?>



        </div>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="form-group">
            <?php echo $form->labelEx($model,'content'); ?>
            <?php $this->widget('application.extensions.ckeditor.CKEditor', array( 'model' => $model, 'attribute'=>'content', 'language'=>'ru', 'editorTemplate'=>'full',

                'skin'=>'v2',
                "options" => array(
                    "height"=>"400px",
                    "width"=>"100%",

                ),
            )); ?>


        </div>

        <div class="row btn text-center col-md-6">
           <button type="submit" class="btn btn-primary  btn-block">Сохранить</button>
        </div>

        <?php $this->endWidget(); ?>
    </div>





</div>

<script>
    $(":date").dateinput();
</script>