<?php
/* @var $this CmsPageController */
/* @var $model CmsPage */


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cms-page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал страниц</h1>


<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php
echo CHtml::form();
echo "<br>";
echo CHtml::submitButton('Опубликовать',array('name'=>'opyblic','class'=>'btn btn-primary','style'=>'width : 200px'));
echo "<br>";
echo "<br>";
echo CHtml::submitButton('Снять с публикации',array('name'=>'del','class'=>'btn btn-primary','style'=>'width : 200px'));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cms-page-grid',
	'dataProvider'=>$model->search(),
    'selectableRows'=>2,
	'filter'=>$model,
	'columns'=>array(
		'id' => array(
            'name'=>'id',
            'headerHtmlOptions'=>array('width'=>30),

        ),
        array('class'=>'CCheckBoxColumn',
        'id'=>'page_id',

        ),

		'title',
	    'created'=>array(
            'name'=>'created',
            'value'=>'date("j.m.Y.H:i",$data->created)',
            'filter'=>false,
        ),
		'status'=>array(
            'name'=>'status',
            'value'=>'$data->getStatus($data->status)',
            'filter'=>array(1=>"На модерацию",2=>"Опубликовать",3=>"Снять с пуб"),

        ),
		'category_id'=> array(
            'name'=>'category_id',
            'value'=>'$data->category->title',
            'filter'=>CmsCategory::all(),
        ),

        'user_id'=> array(
            'name'=>'user_id',
            'value'=>'$data->user->username',
            'filter'=>CmsUser::all(),
        ),
		array(
			'class'=>'CButtonColumn',
            'viewButtonOptions'=> array('style'=>'display:none'),
		),
	),
)); ?>

<?php
echo CHtml::endForm();
?>