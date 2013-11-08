<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $eurocode
 * @property string $prodcode
 * @property double $price
 * @property string $brand
 * @property string $features
 * @property integer $available
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, eurocode, prodcode, price, brand, features, available', 'required'),
			array('available', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('code', 'length', 'max'=>32),
			array('name, eurocode, prodcode, brand', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, eurocode, prodcode, price, brand, features, available', 'safe', 'on'=>'search'),
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
			'code' => 'Secode',
			'name' => 'Наименование',
			'eurocode' => 'Еврокод',
			'prodcode' => 'Код производителя',
			'price' => 'Цена',
			'brand' => 'Бренд',
			'features' => 'Характеристики',
			'available' => 'Доступность',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('eurocode',$this->eurocode,true);
		$criteria->compare('prodcode',$this->prodcode,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('features',$this->features,true);
		$criteria->compare('available',$this->available);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Получение списка продукции определенной марки, модели и модификации
	 */
	public function getProducts($mark, $model, $modification)
	{
		return Yii::app()->db->createCommand("SELECT
			product.id,
			product.name,
			product.eurocode,
			product.price,
			product.brand,
			product.features,
			product.available
			FROM mark, model, modification, product, secodes
			WHERE mark.name='$mark'
			AND model.name='$model'
			AND modification.name='$modification'
			AND mark.id=model.mark_id
			AND model.id=modification.model_id
			AND modification.secode=secodes.name
			AND product.code=secodes.name
			ORDER BY product.name")->queryAll();
	}

	/**
	 * Получение информации о продукте по идентификатору
	 * @param integer $pid
	 */
	public function getProd($pid)
	{
		return Yii::app()->db->createCommand("SELECT name, brand, price FROM product WHERE id=$pid")->queryRow();
	}
}
