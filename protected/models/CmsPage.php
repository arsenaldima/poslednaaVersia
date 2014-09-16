<?php

/**
 * This is the model class for table "cms_page".
 *
 * The followings are the available columns in table 'cms_page':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $created
 * @property integer $status
 * @property integer $user_id
 * @property string $path_img
 * @property integer $category_id
 */
class CmsPage extends CActiveRecord
{


    public $image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content,  status, category_id', 'required'),
			array('created, status, category_id', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>255),

            array('image', 'file', 'types'=>'jpg, gif, png'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'on'=>'update'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, created, status, category_id, user_id, path_img', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('user'=> array(self::BELONGS_TO,'CmsUser','user_id'),
                     'category'=> array(self::BELONGS_TO,'CmsCategory','category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'content' => 'Содержимое',
			'created' => 'Дата создания',
			'status' => 'Статус',
			'category_id' => 'Категория',
            'user_id'=>'Пользователь',
            'path_img'=>'Изображение страницы',
            'image'=>'Титульная картинка страницы',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('status',$this->status);
		$criteria->compare('category_id',$this->category_id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->condition='status > 0';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function all()
    {
        return CHtml::listData(self::model()->findAll(),'id','title');
    }

    public function beforeSave()
    {
        if($this->isNewRecord)
        {
            $this->CheckScript();
            $this->SaveImage();

            if(empty($this->created))
                $this->created=time();
                $this->user_id=Yii::app()->user->id;
                $model=CmsSetting::model()->findByPk(1);

            if(($model->publicazia_stat==1)&&($this->status!=0))
                $this->status=2;
        }
        return parent::beforeSave();
    }



    public static function MyPages($id)
    {
        $criteria= new CDbCriteria;
        if($id==Yii::app()->user->id)
        {
            $criteria->condition='user_id=:id AND status=0 OR status=2';
            $criteria->params=array(':id'=>$id);
        }
        else
        {
            $criteria->condition='user_id=:id AND status=2';
            $criteria->params=array(':id'=>$id);
        }


        return new CActiveDataProvider('CmsPage',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>5),));
    }



    public static function vivod($id)
    {
        $criteria= new CDbCriteria;
        $criteria->condition='status = 2';
        $criteria->compare('category_id',$id);

        $model=CmsSetting::model()->findByPk(1);
        return new CActiveDataProvider('CmsPage',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>$model->ct_page),));
    }

    public static function getStatus($stat)
    {
        $ar = array(1=>'На модерацию',2=>'Опубликовать',3=>'Снять с пуб');
        return $ar[$stat];
    }

    public function SaveImage()
    {
        $image=CUploadedFile::getInstance($this,'image');
        $this->image=$image;
        $rand=uniqid();
        $this->image->saveAs('./images/'.Yii::app()->user->id.'/pages/'.$rand.$this->image->name);
        $this->path_img = $rand.$this->image->name;

    }
    public function CheckScript()
    {
        $p = new CHtmlPurifier();
        $p->options = array('URI.AllowedSchemes'=>array(
            'http' => true,
            'https' => true,
        ));
        $this->content = $p->purify($this->content);
    }
}
