<?php
/* @var $this UserPersonalController */
/* @var $data CmsComment */
?>

<div class="row container-fluid">
    <br>

        <div class="panel-heading text-center">
            <?
            echo CHtml::link('<h3>'.$data->page->title.'</h3>',array('/page/view','id'=>$data->page->id));
            ?>
        </div>

        <div class="panel panel-body">
           <div class="text-left"><small>Дата создания &nbsp;&nbsp;&nbsp;<? echo CHtml::encode(date('j.m.Y H:i',$data->created));?></small></div>
           <hr/>

           <div class="text-left">
              <?
                    echo $data->content;
                    echo"<br>";
              ?>
           </div>


        </div>

</div>
