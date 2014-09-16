<?php
/* @var $this CmsUserController */
/* @var $model CmsUser */


if(Yii::app()->user->hasFlash('error'))
echo Yii::app()->user->getFlash('error');
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cms-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cms Users</h1>


<?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php
$ar=array('class'=>'CButtonColumn','updateButtonOptions'=>array('style'=>'display:none'));

if(Yii::app()->user->checkAccess(2))
{  $ar['deleteButtonOptions']= array('style'=>'display:none');

}

    echo "<br>";
    echo CHtml::form();
    echo CHtml::submitButton('Разбанить',array('name'=>'noban','class'=>'btn btn-primary','style'=>'width : 200px'));
    echo CHtml::submitButton('зaбанить',array('name'=>'ban', 'class'=>'btn btn-primary','style'=>'width : 200px'));
echo "<br>";
echo "<br>";
if(Yii::app()->user->checkAccess(3))
{
    echo CHtml::submitButton('Назначить модератором',array('name'=>'mod','class'=>'btn btn-primary','style'=>'width : 200px'));
    echo CHtml::submitButton('Снять с модераторства',array('name'=>'no_mod','class'=>'btn btn-primary','style'=>'width : 200px'));
}
    ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cms-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array(
            'class'=>'CCheckBoxColumn',
            'id'=>'user_id',

        ),
		'username',
		'password',
        'email',
        'created'=>array(
            'name'=>'created',
            'value'=>'date("j.m.Y.H:i",$data->created)',
            'filter'=>false,
        ),

        'ban'=>array(
            'name'=>'ban',
            'value'=>'($data->ban==1)?"бан":" "',
            'filter'=>array(0=>"да",1=>"нет"),

        ),

        'role'=>array(
            'name'=>'role',
            'value'=>'$data->getUser($data->role)',
            'filter'=>array(1=>"Юзер",2=>"Модератор",3=>"Админ"),

        ),

		$ar
	),
));

echo CHtml::endForm();

?>
