<?php
/* @var $this CmsPageController */
/* @var $model CmsPage */?>

<h1>Редактирование страницы <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>