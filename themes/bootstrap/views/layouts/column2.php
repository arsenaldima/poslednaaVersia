<?php /* @var $this Controller */ ?>
<?php session_start(); $this->beginContent('//layouts/main'); ?>


<div class="row" style="margin: 0; padding-right: 0">


   <div class="col-md-3" id="LeftblockId">

       <div class="category">Категории</div>
       <ul class="CatItem">
           <?

           foreach(CmsCategory::menu('top') as $one):?>
           <li>
               <? echo CHtml::openTag('a',array('href'=>Yii::app()->baseUrl.$one['url']['0'],'id'=>'categ','class'=>'activeBtn'));

               ?>
               <div class="row-fluid divBlock">
                   <div class="col-md-4 LeftBkock">
                       <i class="fa fa-chevron-up fa-rotate-90"></i>
                   </div>
                   <div class="col-md-4 CenterBlock">
                    <?echo $one['label'];?>
                   </div>
                   <div class="col-md-4 RightBkock">
                       <?echo $one['data'];?>
                   </div>
               </div>
               <?echo '</a>';?>

           </li>
                <?endforeach;?>
           <li><hr/></li>


       </ul>

   </div>


   <div class="col-md-8" style="width: 75%">

        <div class="container-fluid" style="margin-top: 2%; margin-left: 10%">
            <?php echo $content; ?>
        </div>

   </div>

</div>

<?php $this->endContent(); ?>
