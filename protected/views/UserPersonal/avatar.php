<?php
/* @var $this UserPersonalController */
/* @var $model CmsUser */
?>


<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'cms-user-form',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),

)); ?>

    <div class="row">
        <?php echo $form->fileFieldRow($model, 'image');
        ?> <!-- Вот наше поле загрузки картинки -->
        <br>

      </div>



<br>
<?php echo CmsSetting::carimage($model->picture,200,150,'img-thumbnail bord',0,Yii::app()->user->id); ?>

<br>
    <br>
    <br>
<?php echo CHtml::submitButton('Обновить', array('class' => 'save')); ?>
<?php $this->endWidget(); ?>