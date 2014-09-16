<?
/**
 * @var $this CController
 * @var $model User
 */
?>

<p>Для восстановления пароля перейдите по ссылке: </p>
<p><?=CHtml::link($this->createAbsoluteUrl('site/login', array('token' => $model->getRecoveryPasswordToken())), $this->createAbsoluteUrl('site/login', array('token' => $model->getRecoveryPasswordToken())))?></p>
<p>Ссылка будет работать 5 часов</p>