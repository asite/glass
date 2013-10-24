<?php

/**
 * This is the model class for table "modification".
 *
 * The followings are the available columns in table 'modification':
 * @property string $id
 * @property string $name
 * @property string $secode
 * @property string $model_id
 * @property integer $pop
 */
class Modification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, secode, model_id, pop', 'required'),
			array('pop', 'numerical', 'integerOnly'=>true),
			array('secode', 'length', 'max'=>32),
			array('model_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, secode, model_id, pop', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'secode' => 'Secode',
			'model_id' => 'Model',
			'pop' => 'Pop',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('secode',$this->secode,true);
		$criteria->compare('model_id',$this->model_id,true);
		$criteria->compare('pop',$this->pop);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Получение модификаций марки и модели
	 */
	public function getModifications($mark, $model)
	{
		return Yii::app()->db->createCommand("SELECT modification.name, modification.pop
			FROM mark, model, modification
			WHERE mark.id=model.mark_id
			AND model.id=modification.model_id
			AND mark.name='$mark'
			AND model.name='$model'
			ORDER BY modification.name")->queryAll();
	}

	/**
	 * Получение всех модификаций
	 */
	public function getModifList()
	{
		return Yii::app()->db->createCommand("SELECT
			modification.id,
			modification.name modifname,
			modification.secode,
			model.name modelname,
			mark.name markname,
			modification.pop
			FROM mark, model, modification
			WHERE mark.id=model.mark_id AND
			model.id=modification.model_id
			ORDER BY modification.id")->queryAll();
	}
}
