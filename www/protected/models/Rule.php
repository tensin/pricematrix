<?php

/**
 * This is the model class for table "ru_rule".
 *
 * The followings are the available columns in table 'ru_rule':
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property string $event
 * @property string $sort
 */
class Rule extends EActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rule the static model class
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
		return 'ru_rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, title, event, depend', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>25),
			array('event, depend', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, title, event, depend', 'safe', 'on'=>'search'),
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
            'actions'=>array(self::HAS_MANY, 'RuleAction', 'ruleId', 'order'=>"weight asc"),
            'conditions'=>array(self::HAS_MANY, 'RuleCondition', 'ruleId', 'order'=>"conjunction desc"),
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
			'title' => 'Title',
			'event' => 'Event',
			'depend' => 'Depend',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('event',$this->event,true);
		$criteria->compare('depend',$this->depend,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public function searchById($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$id);
        $criteria->compare('userId',$this->userId);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('event',$this->event,true);
        $criteria->compare('depend',$this->depend,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}