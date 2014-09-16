<?php
/* @var $this CmsCategoryController */
/* @var $model CmsCategory */



$this->menu=array(

	array('label'=>'Создать категорию', 'url'=>array('/admin/CmsCategory/create')),
);

Yii::app()->clientScript->registerScript('Поиск', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cms-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал категорий</h1>


<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cms-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'position',
		array(
			'class'=>'CButtonColumn',
            'viewButtonOptions'=> array('style'=>'display:none'),
		),
	),
)); ?>
