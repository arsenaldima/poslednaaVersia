<?php
/* @var $comments*/
Yii::app()->clientScript->registerCssFile('http://web/css/page.css');
?>

<br>

<ol  class="comments-list" type="1">
    <?php foreach($comments as $comment):?>

        <li id="<?php echo $comment->id; ?>">

            <?php if($comment->status==1):?>


                    <div class="row">
                        <div >
                            <div class="col-md-3"><?echo CmsSetting::carimage($comment->user->picture,164,164,'img-thumbnail bord',0,Yii::app()->user->id);?></div>
                                <div class="col-md-9 container-fluid">
                                <table>
                                    <tr>
                                        <td style="width: 50%; text-align: center">
                                            <?php if($comment->user_id!=null): ?>
                                            <?php echo CHtml::link(CmsUser::get_name($comment->user_id),array('UserPersonal/index','id'=>$comment->user_id)); endif; ?>
                                            <?php if($comment->user_id==null): ?>

                                            <?php echo CHtml::encode($comment->guest); endif ?>

                                            <small ><?php echo '&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.date('d F Y',$comment->created);?></small>
                                        </td>

                                        <td style="width: 50%; text-align: center">
                                            <?php
                                                if((Yii::app()->user->id==$comment->user_id)&&(!Yii::app()->user->isGuest))
                                                    echo '&nbsp;'.'&nbsp;'.CHtml::link('Удалить',array('/page/delete','id'=>$comment->id)).'&nbsp;/&nbsp;' ?>
                                                <a id="<?php echo $comment->id; ?>" class="li_n">Ответить</a>

                                        </td>
                                    </tr>
                                </table>
                                    <hr/>

                                <?php echo CHtml::encode($comment->content);?>

                            </div>
                        </div>

                    </div>
                <hr/>













            <?php if(count($comment->childs) > 0 ) $this->renderPartial('_view', array('comments' => $comment->childs));?>

            <?php endif ?>

        </li>

    <?php endforeach;?>
</ol>


