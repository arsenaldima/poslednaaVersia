<?
/**
 * @var $this CController
 * @var $user CmsUser
 */
?>
<p>Сообщение с сайта  <a target="_blank" href="http://web/site/index">http://web/</a></p><br>
<p>Пользователь <?=CHtml::link($user->username, $this->createAbsoluteUrl('UserPersonal/ChangeEmail/', array('id' => $user->id)))?> перейдите по ссылке для смены email</p>