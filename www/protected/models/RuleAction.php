<?php

/**
 * This is the model class for table "ru_rule_action".
 *
 * The followings are the available columns in table 'ru_rule_action':
 * @property integer $id
 * @property integer $ruleId
 * @property string $column
 * @property string $callback
 * @property string $callbackArgs
 * @property string $weight
 */
class RuleAction extends EActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RuleAction the static model class
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
		return 'ru_rule_action';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ruleId, column, callback, callbackArgs, weight', 'required'),
			array('ruleId', 'numerical', 'integerOnly'=>true),
			array('column, callback, callbackArgs, weight', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ruleId, column, callback, callbackArgs, weight', 'safe', 'on'=>'search'),
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
            'rules'=>array(self::BELONGS_TO, 'Rule', 'id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ruleId' => 'Rule',
			'column' => 'Column',
			'callback' => 'Callback',
			'callbackArgs' => 'Callback Args',
			'weight' => 'Weight',
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
		$criteria->compare('ruleId',$this->ruleId);
		$criteria->compare('column',$this->column,true);
		$criteria->compare('callback',$this->callback,true);
		$criteria->compare('callbackArgs',$this->callbackArgs,true);
		$criteria->compare('weight',$this->weight,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public function searchByRuleId($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('ruleId',$id);
        $criteria->compare('column',$this->column,true);
        $criteria->compare('callback',$this->callback,true);
        $criteria->compare('callbackArgs',$this->callbackArgs,true);
        $criteria->compare('weight',$this->weight,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}