<?php
/**
 * Created by JetBrains PhpStorm.
 * User: дима
 * Date: 01.08.14
 * Time: 12:17
 * To change this template use File | Settings | File Templates.
 */

?>
<div class="row">

        <div class="thumbnail">
            <?echo CmsSetting::carimage($data->path_img,630,150,'img-thumbnail img-bord',1,$data->user->id);?>

            <div class="caption">

                <div class="hrd text-center">

                    <h2><? echo   strtoupper($data->title)?></h2>
                    <h3></h3>

                </div>

                <hr/>

                <blockquote>
                    <p>
                        <? echo strstr($data->content, '</p>', true)."..............."; ?>
                    </p>
                </blockquote>


                <p class="text-center">
                    <? echo CHtml::link('Читать далее...',array('page/view','id'=>$data->id),array('class'=>'btn btn-danger'));?>
                </p>

                <hr/>

            </div>

            <div class="text-center">

                <span>
                    <?
                    switch($data->user->role)
                        {
                            case 1: {echo CHtml::link($data->user->username,array('UserPersonal/index','id'=>$data->user->id)); break;}
                            case 2: {echo CHtml::link('Модератор',array('UserPersonal/index','id'=>$data->user->id)); break;}
                            case 3: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.'Администратор'.'</i>',array('UserPersonal/index','id'=>$data->user->id)); break;}
                        }
                    ?>
                    /
                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-calendar')).'&nbsp;'.'&nbsp;'.date('j F Y',$data->created).'</i>',array('page/PageCriteria','data'=>date('Y-m-j',$data->created)));?>
                   /
                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-comment')).'&nbsp;'.CmsComment::model()->countByAttributes(array('page_id'=>$data->id)).'&nbsp;'."Комментариев".'</i>',array('page/view','id'=>$data->id));?>
                </span>

            </div>

        </div>

</div>
