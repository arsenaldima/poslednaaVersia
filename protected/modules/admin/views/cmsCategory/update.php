<?php
/* @var $this CmsCategoryController */
/* @var $model CmsCategory */


$this->menu=array(

	array('label'=>'Создать категорию', 'url'=>array('create')),
	array('label'=>'Журнал категории', 'url'=>array('admin')),
);
?>

<h1>Обновить категорию  <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>