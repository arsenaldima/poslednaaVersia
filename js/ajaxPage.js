/*<![CDATA[*/
        (function($)
        {
            // скрываем стандартный навигатор
            $('.paginator').hide();

            // запоминаем текущую страницу и их максимальное количество

            var page = parseInt('<?php echo (int)Yii::app()->request->getParam("page", 1); ?>');
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

