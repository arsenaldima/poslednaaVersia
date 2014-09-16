<div class="col-md-6">
    <div class="thumbnail <?php echo$classDiv?>">
        <?echo CmsSetting::carimage($data->path_img,630,150,'img-thumbnail',1,$data->user->id);?>
        <div id="<?echo$classDiv?>"></div>
        <div class="caption">

            <div class="hrd text-center">

                <h2><? echo   strtoupper($data->title)?></h2>
                <h3></h3>

            </div>


            <br>
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
                        case 1: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.$data->user->username.'</i>',array('UserPersonal/index','id'=>$data->user->id)); break;}
                        case 2: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.'Модератор'.'</i>',array('UserPersonal/index','id'=>$data->user->id)); break;}
                        case 3: {echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-user')).'&nbsp;'.'&nbsp;'.'Администратор'.'</i>',array('UserPersonal/index','id'=>$data->user->id)); break;}
                    }
                    ?>

                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-calendar')).'&nbsp;'.'&nbsp;'.date('j F Y',$data->created).'</i>',array('page/index','data'=>date('Y-m-j',$data->created),'id'=>$data->category->id));?>

                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-comment')).'&nbsp;'.CmsComment::model()->countByAttributes(array('page_id'=>$data->id)).'&nbsp;'."Комментариев".'</i>',array('page/view','id'=>$data->id));?>

                    <?echo CHtml::link(CHtml::openTag('i',array('class'=>'fa fa-folder-open')).'&nbsp; Категория &nbsp;'.$data->category->title.'</i>',array('page/index','id'=>$data->category->id));?>
                </span>

        </div>

    </div>
</div>