
<?php
/* @var $this PageController */
/* @var $model CmsPage */
/* @var $form CActiveForm */
/* @var $model1 CmsComment */

Yii::app()->clientScript->registerScriptFile('http://web/js/viewcom.js');
?>
<div class="row">

    <div class="thumbnail">

        <?php if(($model->user_id==Yii::app()->user->id)&&($model->status==0))
        {
            echo CHtml::openTag('div',array('class'=>'text-center'));
            echo "<hr/>";
            echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-pencil')).'&nbsp;'.'&nbsp;'.'Редактировать'.'</i>',array('UserPersonal/update','id'=>$model->id),array('class'=>'text-center'));
            echo "<hr/>";
            echo"</div>";
        }?>

        <?echo CmsSetting::carimage($model->path_img,630,150,'img-thumbnail img-bord',1,$model->user->id);?>

        <div class="caption">

            <div class="hrd text-center">

                <h2><? echo   strtoupper($model->title)?></h2>
                <h3></h3>

            </div>


        </div>

        <div class="text-center">

                <span>
                    <?
                    switch($model->user->role)
                    {
                        case 1: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.$model->user->username.'</i>',array('UserPersonal/index','id'=>$model->user->id)); break;}
                        case 2: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.'Модератор'.'</i>',array('UserPersonal/index','id'=>$model->user->id)); break;}
                        case 3: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.'Администратор'.'</i>',array('UserPersonal/index','id'=>$model->user->id)); break;}
                    }
                    ?>
                    /
                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-calendar')).'&nbsp;'.'&nbsp;'.date('j F Y',$model->created).'</i>',array('page/index','data'=>date('Y-m-j',$model->created),'id'=>$data->category->id));?>
                    /
                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-comment')).'&nbsp;'.CmsComment::model()->countByAttributes(array('page_id'=>$model->id)).'&nbsp;'."Комментариев".'</i>',array('page/view','id'=>$model->id));?>
                </span>

        </div>
        <hr/>
        <div class="text-info">
            <? echo $model->content?>
        </div>
        <hr/>




    </div>

</div>

<div class="row">

    <div class="thumbnail textCom">
        <?echo CmsComment::model()->countByAttributes(array('page_id'=>$model->id,'status'=>1));?>  &nbsp; коментариев
        <?
            $flag=CmsSetting::model()->findByPk(1);
            if(!Yii::app()->user->isGuest||(Yii::app()->user->isGuest && $flag->gost_com)):
        ?>
        <a class="linkCom" id="linkComId"><i class="fa fa-pencil-square-o">&nbsp;Оставить Комментарий</i></a>
        <?endif;?>
    </div>
</div>

    <?php
    if(($model->status!=0)&&($model->status!=1))
    {
    $this->renderPartial('_view',array('comments'=> $comments));
    $this->renderPartial('newcomment',array('model'=> $model1));}?>




