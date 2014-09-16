<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
<div class="well well-lg text-center">

    <p class="text-info">
    <h2 class="maintext">Добро пожаловать на <? echo Yii::app()->name?></h2>
    <h4></h4>
    </p>
</div>


<div class="row">
    <div class="container-fluid">
        <?$this->renderPartial('page',array('data'=>$model[0],'classDiv'=>'1'));?>
        <?$this->renderPartial('page',array('data'=>$model[1],'classDiv'=>'2'));?>
    </div>
</div>
<div class="row">
    <div class="container-fluid">
        <?$this->renderPartial('page',array('data'=>$model[2],'classDiv'=>'3'));?>
        <?$this->renderPartial('page',array('data'=>$model[3],'classDiv'=>'4'));?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    var h1 = $('.1').height();
    var h2 = $('.2').height();
    var h3 = $('.3').height();
    var h4 = $('.4').height();
    if(h1>h2)
        $('#2').height(h1-h2);
    if(h2>h1)
        $('#1').height(h2-h1);
    if(h3>h4)
        $('#4').height(h3-h4);
    if(h4>h3)
        $('#3').height(h4-h3);
    });
</script>