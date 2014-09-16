<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <div class="col-md-offset-2">

    </div>

    <div class="col-md-2">

        <?if(!Yii::app()->user->isGuest):?>
        <div class="text-center container-stacked RastOtVerxa">
            <p class="category"><b>ПРОФИЛЬ</b></p>

        </div>

        <?php



        $this->widget('bootstrap.widgets.TbMenu', array(
            'items'=>array(


                array('label'=>'изменение почту','url'=>array('/userPersonal/ChangeEmail','id'=>0)),
                array('label'=>'изменение пароль','url'=>array('/userPersonal/ChangePassword','id'=>0,'time'=>0)),
                array('label'=>'пригласить пользователя','url'=>array('/UserPersonal/PriglDruga')),
                array('label'=>'Создать статью','url'=>array('/userPersonal/create')),
                array('label'=>'Выйти','url'=>array('/site/logout')),
            ),
            'htmlOptions'=>array('class'=>''),
        ));
        endif;
        ?>



    </div>
    <div class="col-md-10">

        <div class="col-md-12">
            <?php echo $content; ?>
        </div>

    </div>


<?php $this->endContent(); ?>

