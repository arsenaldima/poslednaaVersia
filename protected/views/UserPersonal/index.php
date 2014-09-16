<?php
/* @var $this UserPersonalController */
/* @var $id */
/* @var  $model $CmsUser */

$this->breadcrumbs=array(
	'User Personal',
);
Yii::app()->clientScript->registerScriptFile('http://web/js/UserPersonal_index.js');
Yii::app()->clientScript->registerCssFile('http://web/css/page.css');

?>
<div class="row">
        <div class="container">

        <div class="col-md-12 mainDiv">
            <h3 class="text-right textFormat"><?php echo CHtml::encode($model->username); ?></h3>
            <hr/>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-4">
               <?
                    if(Yii::app()->user->id==$id)
                        echo CHtml::link(CmsSetting::carimage($model->picture,228,228,'img-thumbnail',0,$id),array('/UserPersonal/avatar'),array('class'=>'linkFile','enctype'=>'multipart/form-data'));
                    else
                        CmsSetting::carimage($model->picture,228,228,'img-thumbnail',0,$id);

               ?>
        </div>

        <div class="col-md-7">


            <table>
                <tr>
                    <td class="text-left wid">Дата регистрации</td>
                    <td><i class="fa fa-calendar" style="margin-left: 15px"></i></td>
                    <td class="text-center wid"><?php echo date("d F Y H:i",$model->created) ?></td>
                </tr>
                <tr>
                    <?if($model->data_avtor!=0):?>
                        <td class="text-left wid"><span>Заходил </span></td>
                        <td><i class="fa fa-calendar" style="margin-left: 15px"></i></td>
                        <td class="text-center wid"><?php echo date("d F Y H:i",$model->data_avtor) ?></td>
                    <?endif;?>
                </tr>
                <?php if($model->prigl_id!=0):
                    $user=CmsUser::model()->findByPk($model->prigl_id);
                ?>
                <tr>
                    <td class="text-left wid"><span>Приглосил пользователь </span></td>
                    <td><i class="fa fa-child" style="margin-left: 15px"></i></td>
                    <td class="text-center wid"><?php echo CHtml::link($user->username,array('index','id'=>$user->id)); endif; ?></td>

                </tr>

                <tr>
                    <td class="text-left wid"><span>Почта </span></td>
                    <td><i class="fa fa-at" style="margin-left: 15px"></i></td>
                    <td class="text-center wid"><?php echo $model->email ?></td>
                </tr>
                <tr>
                    <?
                        $criteria= new CDbCriteria;
                        $criteria->condition='user_id = :id AND status=2';
                        $criteria->params=array(':id'=>$id);

                            if(CmsPage::model()->count($criteria)!=0):
                    ?>
                                <td class="text-left wid"><span>Опубликовано постов </span></td>
                                <td><i class="fa fa-newspaper-o" style="margin-left: 15px"></i> </td>
                                <td class="text-center wid"><?php echo CmsPage::model()->count($criteria) ?></td>
                            <?endif;?>
                </tr>
                <tr>
                    <?
                        $criteria->condition='user_id=:id AND status=1';
                        $criteria->params=array(':id'=>$id);
                        $ct=CmsComment::model()->count($criteria);
                        if($ct!=0):
                    ?>
                        <td class="text-left wid"><span>Опубликовано комментариев </span></td>
                        <td><i class="fa fa-comment-o" style="margin-left: 15px"></i></td>
                        <td class="text-center wid"><?php  echo $ct;?></td>
                    <?endif;?>
                </tr>
                <tr>
                    <?
                        $criteria=new CDbCriteria();
                        $criteria->condition='user_id=:id AND status=2';
                        $criteria->params=array(':id'=>$id);
                        $criteria->order='created DESC';
                        $criteria->limit='1';
                        $page=CmsPage::model()->find($criteria);
                        if($page!=0):
                    ?>

                    <td class="text-left wid">
                        <span>Последняя статья</span>
                        <div>
                            <?echo date('j F Y H:i',$page->created)?>
                        </div>
                    </td>
                    <td><i class="fa fa-comment-o " style="margin-left: 15px"></i></td>
                    <td class="text-center wid">
                        <?echo CHtml::link($page->title,array('page/view/','id'=>$page->id));?>
                    </td>
                    <?endif;?>
                </tr>
            </table>


            </div>
        </div>

</div>


<div class="row">
    <div class="container-fluid ">
    <?$model2=CmsUser::model()->findAllByAttributes(array('prigl_id'=>array($model->id),));?>

        <div class="col-md-4" style="margin-top: 5%">

            <?echo CHtml::form('','POST',array('id'=>'FormSms','role'=>'form'));?>
            <div class="form-group">
                <label for="InputSms">Введите своё сообщение</label>
                <?
                echo CHtml::hiddenField('id',$id,array('id'=>'IdUser'));
                echo CHtml::textArea('sms','',array('id'=>'SmsId','class'=>'sizeKom form-control','rows'=>'4'));

                ?>
            </div>
            <?echo CHtml::submitButton('Отправить',array('class'=>'btn btn-primary btn-large', 'id'=>'sub_but'));?>
            <?echo CHtml::endForm();?>

            <?
                echo CHtml::openTag('span',array('id'=>'idBut','class'=>'ButPolClass'));
                echo"<br>";

                foreach($model2 as $one)
                {
                echo CHtml::link($one->username,array('index','id'=>$one->id));
                echo "<hr/>";

                }
                echo "</span>";
            ?>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 btn-group-vertical marginButVert">

            <button  id='metka' class="btn btn-success btn-large btn-group-vertical active" >Отправить сообщение пользователю</button>
            <br>
            <?php
                    if($id==Yii::app()->user->id)
                    {
                        ($model->podpis==1)?$dim="Отписаться от рассылки":$dim="Подписаться на рассылку";
                        echo CHtml::button($dim,array('id'=>'but','class'=>'btn btn-success btn-large btn-group-vertical active'));}


                    if($model2!=null)
                    {
                        echo"<br>";
                        echo CHtml::openTag('button',array('class'=>'btn btn-success btn-large btn-group-vertical active', 'id'=>'ButPol'));
                        echo "Показать приглашоных пользователей";
                        echo "</button>";


                    }

            ?>
            <br>
            <button  id='graphShow' class="btn btn-success btn-large btn-group-vertical" >Показать график активности пользователя</button>
            <button  id='graphClose' class="btn btn-success btn-large btn-group-vertical" style="display: none">Скрыть график активности пользователя</button>
            <br>
            <button  id='PageShow' class="btn btn-success btn-large btn-group-vertical" >Показать страницы пользователя</button>
            <button  id='PageClose' class="btn btn-success btn-large btn-group-vertical" style="display: none">Скрыть страницы пользователя</button>
            <br>
            <button  id='CommentShow' class="btn btn-success btn-large btn-group-vertical" >Показать комментарии пользователя</button>
            <button  id='CommentClose' class="btn btn-success btn-large btn-group-vertical" style="display: none">Скрыть комментарии пользователя</button>
        </div>


    </div>
</div>


    <div id="graph" style="display: none">
    <?php    $this->Widget('ext.graph.highcharts.HighchartsWidget', array(
        'options'=>array(
            'title' => array('text' => 'График активности пользователя'),
            'xAxis' => array(
                'categories' => array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август', 'Сентябрь', 'Октябрь','Ноябрь','Декабырь',)
            ),
            'yAxis' => array(
                'title' => array('text' => 'Количество статей')
            ),
            'series' => array(
                array('name' => $model->username, 'data' => CmsSetting::ar_kol($id)),

            )
        )
    ));

    ?>
    </div>


    <div id="MyPage">
    <?
    if(Yii::app()->user->id==$id)
    {
        $a=array('created','status');

    }
    else
    {
        $a=array('created');

    }

     $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>CmsPage::MyPages($id),
        'itemView'=>'_view_pages',
        'emptyText'=>'В данной категории нет статей',
        'sorterHeader'=>'Сортировать по :',
        'sortableAttributes'=>$a,

    )); ?>
    </div>




<div id="MyComment">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>CmsComment::MyComments($id),
        'itemView'=>'_view_comments',
        'emptyText'=>'В данной категории нет статей',
        'sorterHeader'=>'Сортировать по :',
        'template'=>'{items}{pager}',
        'sortableAttributes'=>array('created','page_id'),

    )); ?>
</div>

<br>
<br>
<br>