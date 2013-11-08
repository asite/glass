<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $id
 * @property integer $mounting
 * @property string $clientname
 * @property string $phone
 * @property string $address
 * @property string $date
 * @property integer $time
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mounting, clientname, phone, address, date, time', 'required'),
			array('mounting, time', 'numerical', 'integerOnly'=>true),
			array('clientname', 'length', 'max'=>256),
			array('phone, date', 'length', 'max'=>32),
			array('address', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mounting, clientname, phone, address, date, time', 'safe', 'on'=>'search'),
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
			'mounting' => 'Заказать установку на "выезде"',
			'clientname' => 'Имя',
			'phone' => 'Телефон',
			'address' => 'Адрес',
			'date' => 'Удобное Вам время доставки:',
			'time' => 'Time',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('mounting',$this->mounting);
		$criteria->compare('clientname',$this->clientname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Получение значения последнего ID
	 */
	public function getLastId()
	{
		return Yii::app()->db->createCommand("SELECT id FROM `order` ORDER BY id DESC")->queryRow();
	}

	public function createOrder($id, $mounting, $clientname, $phone, $address, $date, $time, $createDate)
	{
		Yii::app()->db->createCommand("INSERT INTO
			`order`(id, mounting, clientname, phone, address, date, time, create_date) VALUES
			($id, $mounting, '$clientname', '$phone', '$address', '$date', '$time', '$createDate')
			")->execute();
	}
}
