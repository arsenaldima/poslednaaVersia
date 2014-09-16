<?php
/* @var $this PageController */
/* @var $data CActiveDataProvaider */

?>
<div id="listView">
<?php $this->widget('zii.widgets.CListView', array(
    'id'=>'product-grid',
    'dataProvider'=>$data,
    'itemView'=>'_view_page',
    'ajaxUpdate'=>false,
    'pager'=>array(
        'htmlOptions'=>array(
            'class'=>'paginator'
        )
    ),
    'template'=>'{items}{pager}',
    'emptyText'=>'В данной категории нет статей',



)); ?>

</div>

<?php if ($data->totalItemCount > $data->pagination->pageSize): ?>


    <button class="btn btn-info btn-group-justified" id="loading" style="display:none"><i class="fa fa-spinner fa-spin fa-3x"></i></button>
    <button class="btn btn-info btn-group-justified" id="showMore"><h4>Показать ещё</h4></button>

    <script type="text/javascript">
        /*<![CDATA[*/
        (function($)
        {
            // скрываем стандартный навигатор
            $('.paginator').hide();

            // запоминаем текущую страницу и их максимальное количество
            var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
            var pageCount = parseInt('<?php echo (int)$data->pagination->pageCount; ?>');

            var loadingFlag = false;

            $('#showMore').click(function()
            {
                // защита от повторных нажатий
                if (!loadingFlag)
                {
                    // выставляем блокировку
                    loadingFlag = true;

                    // отображаем анимацию загрузки
                    $('#loading').show();

                    $.ajax({
                        type: 'post',
                        url: window.location.href,
                        data: {
                            // передаём номер нужной страницы методом POST
                            'page': page + 1,
                            '<?php echo Yii::app()->request->csrfTokenName; ?>': '<?php echo Yii::app()->request->csrfToken; ?>'
                        },
                        success: function(data)
                        {
                            // увеличиваем номер текущей страницы и снимаем блокировку
                            page++;
                            loadingFlag = false;

                            // прячем анимацию загрузки
                            $('#loading').hide();

                            // вставляем полученные записи после имеющихся в наш блок
                            $('#listView').append(data);

                            // если достигли максимальной страницы, то прячем кнопку
                            if (page >= pageCount)
                                $('#showMore').hide();
                        }
                    });
                }
                return false;
            })
        })(jQuery);
        /*]]>*/
    </script>

<?php endif; ?>