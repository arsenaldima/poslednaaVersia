<?php
/* @var $this CmsUserController */
/* @var $model CmsUser */



$this->menu=array(
	array('label'=>'Журнал пользователя', 'url'=>array('index')),


);
?>

<h1>Просмотр пользователя  <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'created'=>array(
            'name'=>'created',
            'value'=>date("j.m.Y.H:i",$data->created),
        ),
		'ban'=>array(
            'name'=>'ban',
            'value'=>($data->ban==1)?"бан":"no_ban",
        ),
		'role'=>array(
            'name'=>'role',
            'value'=>($data->ban==1)?"User":($data->ban==2)? "Moderator ": "Admin",
        ),
		'email',
	),
)); ?>
