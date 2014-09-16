<?php /* @var $this Controller */ ?>
<?php session_start(); $this->beginContent('//layouts/main'); ?>



    <div class="col-md-offset-2 col-lg-offset-2">

    </div>

    <div class="col-md-2 col-lg-3">
    <div class="container-stacked">
         <div class="dropdown">
            <button class="btn btn-default CatItem dropdown-toggle " type="button" id="dropdownMenu1" data-toggle="dropdown">
                <span> Категории <span class="caret"></span></span>

            </button>
            <ul class="dropdown-menu liDrop list-group" role="menu" aria-labelledby="dropdownMenu1">
                <?
                  foreach(CmsCategory::menu('top') as $one):
                  $a=CHtml::openTag('i',array('class'=>'fa fa-arrow-right pull-left'))."</i>".'&nbsp;'.'&nbsp;'. $one['label'].'&nbsp;'.'&nbsp;'.'&nbsp;'.'&nbsp;'.CHtml::openTag('span',array('class'=>'badge pull-right')).$one['data']."</span>";
                ?>
                <li role="presentation">
                    <?echo CHtml::link($a,$one['url'],array('role'=>'menuitem','tabindex'=>'-1','class'=>'fontLink'))?>


                </li>

                      <li role="presentation" class="divider"></li>
               <?endforeach;?>
            </ul>
        </div>
    </div>

    </div>
    <div class="col-md-8 col-lg-9">

        <div class="container-fluid">
        <?php echo $content; ?>
        </div>

    </div>


<?php $this->endContent(); ?>