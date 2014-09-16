<?php
/**
* Google map extension for Yii 1.x
*
* @author disasterovich@mail.ru
* @site: diz-blog.com.ua
* @ license: GPL
*
*/

class GoogleMap extends CWidget
    {
    public $visible=0;
    public $markers = array();
    public $params = array('visible'=>true,'zoom'=>13,'width'=>'420px','height'=>'210px','lat' => 45.300, 'lng' => 34.400,);

    // этот метод будет вызван внутри CBaseController::beginWidget()
    public function init()
        {
        Yii::app()->clientScript->registerScript(0,
                'google_maps_markers='.CJSON::encode($this->markers).';'.
                'google_maps_params='.CJSON::encode($this->params).';',
                CClientScript::POS_READY
                );

        $this->publishAssets();

        parent::init();
        }

    // этот метод будет вызван внутри CBaseController::endWidget()
    public function run()
        {
        $this->render( 'googlemap',array('params'=>$this->params) );
        }

    public function publishAssets()
        {
        $assets = dirname(__FILE__).'/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);
        if(is_dir($assets)) 
            {
            Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/googlemap.js', CClientScript::POS_HEAD);
            } 
        else 
            {
            throw new Exception('Google map - Error: Couldn\'t find assets to publish.');
            }
        }
    }
