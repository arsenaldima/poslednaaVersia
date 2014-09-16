<?
/* @var $text*/
/* @var $user CmsUser*/

?>
<p>Сообщение с сайта  <a target="_blank" href="http://web/">http://web/</a></p><br>
<p>Пользователь  <?=CHtml::link($user->username, array('http://web/UserPersonal/index/','id' => $user->id))?> отправил вам личное сообщение</p>\
<p><?php CHtml::encode($text) ?> </p>