<?php

/**
 * This is the model class for table "ru_user_file".
 *
 * The followings are the available columns in table 'ru_user_file':
 * @property integer $id
 * @property integer $userId
 * @property integer $templateId
 * @property string $hash
 * @property string $mime
 * @property string $created
 */
class UserFile extends EActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ru_user_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	const FILE_SAVE_PATH = './protected/data/prices';

    public $file = null;
	public $url = null;
	public $uploadType = null;
	

    public function getFilename()
    {
        if (!is_null($this->file))
            return $this->file;

        $mime = array(
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-excel' => 'xls',
            'text/xml'=>'xml',
            'text/comma-separated-values'=>'csv',
        );
        return $this->hash . '.' . $mime[$this->mime];
    }

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file', 'file', 'types'=>'xls, xlsx, csv, txt, xml, yml', 'on'=>'createByFile'),
			array('file', 'required', 'on'=>'createByFile'),
			
			//array('hash', 'unique', 'message'=>'Same file already exists.'),
			
			array('userId, hash, mime', 'required'),
			array('userId, templateId', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>32),
			array('mime', 'length', 'max'=>100),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, templateId, hash, mime, created', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'templateId' => 'Template',
			'title' => 'Title',
			'hash' => 'Hash',
			'mime' => 'Mime',
			'created' => 'Created',
		);
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('templateId',$this->templateId);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('mime',$this->mime,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    //ищем в базе, есть идентичный по md5 файл
    /*public function validate($hash){
        $criteria = new CDbCriteria;
        $criteria->condition = "hash=:hash";
        $criteria->params = array(':hash' => $hash);
        return(UserFile::model()->find($criteria)) ? false : true;
    }*/

}