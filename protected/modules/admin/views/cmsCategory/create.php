<?php
/* @var $this CmsCategoryController */
/* @var $model CmsCategory */



$this->menu=array(
		array('label'=>'Журнал категорий', 'url'=>array('index')),
);
?>

<h1>Создать категорию</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>