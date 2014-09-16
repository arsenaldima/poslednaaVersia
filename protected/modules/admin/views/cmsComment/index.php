<?php
/* @var $this CmsCommentController */
/* @var $model CmsComment */




Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cms-comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал коментариев</h1>


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

?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cms-comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectableRows'=>2,
	'columns'=>array(
		'id'=>array(
            'name'=>'id',
            'headerHtmlOptions'=>array('width'=>30),
        ),
        array('class'=>'CCheckBoxColumn',
            'id'=>'page_id',

        ),
        'status'=>array(
            'name'=>'status',
            'value'=>'($data->status==0)?"Скрыт":"Опубликован"',
            'filter'=>array(0=>"Скрыт",1=>"Опубликован"),
        ),
        'content',

		'page_id'=> array(
            'name'=>'page_id',
            'value'=>'$data->page->title',
            'filter'=>CmsPage::all(),
        ),


        'created'=>array(
            'name'=>'created',
            'value'=>'date("j.m.Y.H:i",$data->created)',
            'filter'=>false,
        ),

        'user_id'=> array(
            'name'=>'user_id',
            'value'=>'$data->user->username',
            'filter'=>CmsUser::all(),
        ),
		'guest',
		array(
			'class'=>'CButtonColumn',
            'updateButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
