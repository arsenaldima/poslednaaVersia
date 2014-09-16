<?
/**
 * @var $this CController
 * @var $user CmsUser
 */
?>
<p>Сообщение с сайта  <a target="_blank" href="http://web/site/index">http://web/</a></p><br>
<p>Пользователь  <?php echo CHtml::link($user->username, $this->createAbsoluteUrl('site/registration/', array('id' => $user->id)))?> приглашает Вас на сайт</p>