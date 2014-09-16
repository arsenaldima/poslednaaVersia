yii-google-map-widget
=====================

Простое расширение для создания карты google maps и установки на ней маркеров


Пример:

$this->widget('ext.yii-google-map-widget-master.GoogleMap',
array
(
'markers' => array
   (
   array
      (
      'lat' => $latitude,
      'lng' => $longitude,
      'draggable'=>false,
      'title'=>'Это заголовок маркера',
      ),
   ),
'params' => array
   (
   'visible'=>true,
   'zoom'=>13,
   'width'=>'100%',
   'height'=>'425px',
   ),
)
);
