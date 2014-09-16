<?
/**
 * @var $this CController
 * @var $user CmsUser
 */
?>
<p>Сообщение с сайта  <a target="_blank" href="<? echo Yii::app()->getBaseUrl(); ?>">http://web/site/index</a></p><br>
<p>Пользователь <?=CHtml::link($user->username, $this->createAbsoluteUrl('UserPersonal/ChangePassword/', array('id' => $user->id,'time'=>time())))?>  Для сменны пароля перейдите по ссылке</p>