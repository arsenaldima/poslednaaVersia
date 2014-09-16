<?php
/* @var $this UserPersonalController */
/* @var $data CmsPage */
?>
<div class="row panel panel-info text-center">
    <div class="panel-heading">
        <?
            echo CHtml::link('<h4>'.$data->title.'</h4>',array('/page/view','id'=>$data->id));
        ?>
    </div>
    <div class="container-fluid panel-body">
        <div class="col-md-6">
            <?echo CmsSetting::carimage($data->path_img,128,128,'img-thumbnail',1,$data->user->id);?>
        </div>
        <div class="col-md-6">
            <table>
                <tr class="StrTable">
                    <td>Статус:</td>
                    <td>
                        <?
                            if($data->status==0)
                                echo "Черновик";
                            else
                                if($data->status==2)
                                    echo "Опубликованая";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td><? echo CHtml::encode(date('j.m.Y H:i',$data->created));?></td>
                </tr>
            </table>
        </div>

    </div>

</div>





