<?php

/**
 * This is the model class for table "cms_setting".
 *
 * The followings are the available columns in table 'cms_setting':
 * @property integer $id
 * @property integer $ct_page
 * @property integer $time
 * @property integer $podtv_email
 * @property integer $poblicazia_com
 * @property integer $publicazia_stat
 * @property integer $gost_com
 *
 */
class CmsSetting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ct_page,  time', 'required'),
			array('ct_page,  podtv_email, poblicazia_com, publicazia_stat, gost_com', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ct_page,  time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ct_page' => 'Количество статей на страницу',
		   'time'=>'Время жизни ссылки',
            'podtv_email'=>'Подтверждение email при авторизации ',
            'poblicazia_com'=>'Публикация комментариев после модерации ',
            'publicazia_stat'=>'Публикация статьи после модерации',
            'gost_com'=>'Может гость оставлять комментарии',



		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ct_page',$this->ct_page);
		$criteria->compare('ct_com',$this->ct_com);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsSetting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function ar_kol($id_user)
    {
        $model=CmsPage::model()->findAllByAttributes(array('user_id'=>array($id_user)));

        $ar=array();

        $rr=date_parse(date("j.m.Y.H:i",time()));

        for($i=0;$i<$rr['month'];$i++)
            $ar[$i]=0;

        foreach($model as $one)
        {
            $rr=date_parse(date("j.m.Y.H:i",$one->created));
            $ar[$rr['month']-1]++;
        }

        return $ar;

    }

    public static  function carimage($name, $width='200', $heigth='200', $class='image',$path,$id)
    {
        $flag=false;
      switch($path)
      {
          case 0:{ if((file_exists('./images/'.$id.'/avatars/'.$name)&&($name!=null)))


              return CHtml::image('http://web/images/'.$id.'/avatars/'.$name,$name,
                  array(
                      'width'=>$width,
                      'height'=>$heigth,
                      'class'=>$class,
                  ));

          else{
              $flag=true;
              break;}
                  }

          case 1:{ if((file_exists('./images/'.$id.'/pages/'.$name)&&($name!=null)))


              return CHtml::image('http://web/images/'.$id.'/pages/'.$name,$name,
                  array(
                      'width'=>$width,
                      'height'=>$heigth,
                      'class'=>$class,
                  ));

                     else{
                         $flag=true;
                         break;}
          }
      }
            if($flag)
            return CHtml::image('http://web/images/default/1.jpg','No photo',
                array(
                    'width'=>$width,
                    'height'=>$heigth,
                    'class'=>$class
                ));
    }

    public static  function user_browser($agent) {
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", $agent, $browser_info); // регулярное выражение, которое позволяет отпределить 90% браузеров
        list(,$browser,$version) = $browser_info; // получаем данные из массива в переменную
        if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera)) return 'Opera '.$opera[1]; // определение _очень_старых_ версий Оперы (до 8.50), при желании можно убрать
        if ($browser == 'MSIE') { // если браузер определён как IE
            preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie); // проверяем, не разработка ли это на основе IE
            if ($ie) return $ie[1].' based on IE '.$version; // если да, то возвращаем сообщение об этом
            return 'IE '.$version; // иначе просто возвращаем IE и номер версии
        }
        if ($browser == 'Firefox') { // если браузер определён как Firefox
            preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff); // проверяем, не разработка ли это на основе Firefox
            if ($ff) return $ff[1].' '.$ff[2]; // если да, то выводим номер и версию
        }
        if ($browser == 'Opera' && $version == '9.80') return 'Opera '.substr($agent,-5); // если браузер определён как Opera 9.80, берём версию Оперы из конца строки
        if ($browser == 'Version') return 'Safari '.$version; // определяем Сафари
        if (!$browser && strpos($agent, 'Gecko')) return 'Browser based on Gecko'; // для неопознанных браузеров проверяем, если они на движке Gecko, и возращаем сообщение об этом
        return $browser; // для всех остальных возвращаем браузер и версию
    }
}
