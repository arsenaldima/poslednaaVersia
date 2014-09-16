<?php $this->widget('zii.widgets.CListView', array(
    'ajaxUpdate'=>false,
    'dataProvider'=>$data,
    'itemView'=>'_view_page',
    'template'=>'{items}',
)); ?>