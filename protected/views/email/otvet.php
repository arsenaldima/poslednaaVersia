<?
/**
 * @var $this CController
 * @var $user CmsUser
 * @var $model CmsComment
 */
?>
<p>Сообщение с сайта  <a target="_blank" href="<? echo $this->createAbsoluteUrl;?>">http://web/</a></p><br>

<?php if($user!=null): ?>
<div>Пользователь <?php echo CHtml::encode($user->username) ?></div>
<?php endif ;?>

<?php if($user==null): ?>
<div>Гость с  email <?php echo CHtml::encode($model->guest) ?></div>
<?php endif;?>

<div>Ответил на ваш коментарий <?php echo CHtml::encode($model->content); ?> </div>
<div>Перейти к странице с коментариями <?php echo CHtml::link('Страница с коментарием', array('http://web/page/view','id'=>$model->page_id)); ?></div>