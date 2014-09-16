<?php

/**
 * This is the model class for table "cms_user".
 *
 * The followings are the available columns in table 'cms_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $created
 * @property integer $ban
 * @property integer $role
 * @property string $email
 * @property string $picture
 * @property string $prigl_id
 * @property string $data_avtor
 * @property string $podpis
 */
class CmsUser extends CActiveRecord
{

    const ROLE_ADMIN = 'Admin';
    const ROLE_MODERATOR= 'Moderator';
    const ROLE_USER = 'User';
    const ROLE_BANNED = 'banned';




    public $verifyCode;
    public $repeat_password;
    public $image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password,email, username', 'required'),
			array('created, ban, role', 'numerical', 'integerOnly'=>true),
            array('email','email'),
            array('email','email','on'=>'em'),
            array('username','unique'),
			array('username, password, email', 'length', 'max'=>255),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'registration'),

            array('image', 'file', 'types'=>'jpg, gif, png, jpeg','allowEmpty'=>true,'on'=>'ava'),


            // порверка пароля
            array('password, repeat_password', 'length', 'max'=>64),
            array('password', 'required', 'on' => 'registration'),

            // проверка повтора пароля
            array('repeat_password', 'compare', 'compareAttribute'=>'password', 'on' => array('registration')),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, data_avtor, podpis ,username, password,prigl_id, created, ban, email', 'safe', 'on'=>'search'),
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
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'created' => 'Дата авторизации',
			'ban' => 'Бан',
			'role' => 'Роли',
			'email' => 'E-mail',
            'repeat_password'=>'Повторить пароль',
            'verifyCode'=>'Код с картинки',
            'prigl_id'=>'Пригласил',
            'data_avtor'=>'Дата посл авторизации',
            'podpis'=>'Подписка на рассылку',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('ban',$this->ban);
        $criteria->compare('role',$this->role);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('prigl_id',$this->prigl_id,true);
        $criteria=new CDbCriteria;
        $criteria->condition='role<3';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function beforeSave(){


        if($this->isNewRecord)
        {

            $this->ban=0;
            $this->role=1;
            $this->created=time();
            $this->podpis=0;

        }



        $this->password=md5('lkjhgfd'.$this->password);

        return parent::beforeSave();

    }

    public static function all()
    {
        return CHtml::listData(self::model()->findAll(),'id','username');
    }

    public static function get_name($id)
    {
       $model=self::model()->findByPk($id);
        return CHtml::encode($model->username);
    }

    public static function sendInvite($email)//Приглащение пользователя на сайт
    {
        $user = self::model()->findAllByPk(Yii::app()->user->id);

        Yii::app()->mailer->AddAddress($email);
        Yii::app()->mailer->Subject = 'Приглашение на сайт';
        Yii::app()->mailer->Body = Yii::app()->controller->renderPartial('/email/invite', array('user' => $user), true);
        Yii::app()->mailer->Send();

        return true;
    }

    public static function sendChange()
    {
        $user = self::model()->findByPk(Yii::app()->user->id);

        Yii::app()->mailer->AddAddress($user->email);
        Yii::app()->mailer->Subject = 'Смена email';
        Yii::app()->mailer->Body = Yii::app()->controller->renderPartial('/email/change', array('user' => $user), true);
        Yii::app()->mailer->Send();

        return true;
    }


    public static function sendPas()
    {
        $user = self::model()->findByPk(Yii::app()->user->id);

        Yii::app()->mailer->AddAddress($user->email);
        Yii::app()->mailer->Subject = 'Смена пароля';
        Yii::app()->mailer->Body = Yii::app()->controller->renderPartial('/email/pas', array('user' => $user), true);
        Yii::app()->mailer->Send();

        return true;
    }

    public static function sendSms($text,$id)
    {
        $user = self::model()->findByPk(Yii::app()->user->id);
        $user2 = self::model()->findByPk($id);
        Yii::app()->mailer->AddAddress($user2->email);
        Yii::app()->mailer->Subject = 'Личное сообщение';
        Yii::app()->mailer->Body = Yii::app()->controller->renderPartial('/email/sms', array('user' => $user,'text' => $text), true);
        Yii::app()->mailer->Send();

        return true;
    }



    public static function getUser($stat)
    {

        $ar=array(1=>'Пользователь',2=>'Модератор',3=>'Админ');
        return $ar[$stat];
    }


//***************************************************************************
    // Работа с моделью
    //***************************************************************************


    /**
     * Проверка пароля
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Хеширование пароля
     *
     * @param $password
     * @param $salt
     * @return string
     */
    public function hashPassword($password)
    {
        return hash('sha256', "dima" . sha1($password));
    }

    /*
     * Получить токен
     *
     * @return string
     */
    public static function getAuthToken($id, $username)
    {
        return sha1($id . Yii::app()->params['authTokenPrivateKey'] . $username);
    }


    public function getRecoveryPasswordToken($expires = 5, $time = null)
    {
        $set=CmsSetting::model()->findByPk(1);
        $expires=$set->time;

        $passHash = self::hashPassword($this->password);
        $time = is_null($time) ? time() : $time;
        $hash = sha1(Yii::app()->params['recoveryPasswordPrivateKey'] . $passHash . $this->username . $this->id . $time. $expires);
        return implode(':', array($time, $expires, $this->id, $hash));
    }

    public static function getByRecoveryPasswordToken($token)
    {
        list($time, $expires, $userId, $hash) = explode(':', trim($token));
        if ($time + $expires * 3600 < time()) return false;
        if (!$user = self::model()->findByPk($userId)) return false;
        if ($user->getRecoveryPasswordToken($expires, $time) != $token) return false;

        return $user;
    }

    public function sendRecoveryPasswordMessage()
    {
        Yii::app()->mailer->AddAddress($this->email);
        Yii::app()->mailer->Subject = 'Восстановление пароля';
        Yii::app()->mailer->Body = Yii::app()->controller->renderPartial('/email/recoveryPassword', array('model' => $this), true);
        Yii::app()->mailer->Send();
    }

    public function SaveImage()
    {
        $image=CUploadedFile::getInstance($this,'image');
        $this->image=$image;
        $rand=uniqid();
        $this->image->saveAs('./images/'.Yii::app()->user->id.'/avatars/'.$rand.$this->image->name);
        $this->picture = $rand.$this->image->name;

    }
}
