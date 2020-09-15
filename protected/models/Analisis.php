<?php

/**
 * This is the model class for table "analisis".
 *
 * The followings are the available columns in table 'analisis':
 * @property integer $id
 * @property integer $rubro
 * @property integer $carta_porte
 * @property integer $producto
 * @property integer $bonifica_rebaja
 * @property double $valor
 *
 * The followings are the available model relations:
 * @property Producto $producto0
 * @property Rubro $rubro0
 */
class Analisis extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'analisis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rubro, carta_porte, producto', 'required'),
			array('rubro, carta_porte, producto, bonifica_rebaja', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rubro, carta_porte, producto, bonifica_rebaja, valor', 'safe', 'on'=>'search'),
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
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
			'rubro0' => array(self::BELONGS_TO, 'Rubro', 'rubro'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rubro' => 'Rubro',
			'carta_porte' => 'Carta Porte',
			'producto' => 'Producto',
			'bonifica_rebaja' => 'Bonifica Rebaja',
			'valor' => 'Valor',
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
		$criteria->compare('rubro',$this->rubro);
		$criteria->compare('carta_porte',$this->carta_porte);
		$criteria->compare('producto',$this->producto);
		$criteria->compare('bonifica_rebaja',$this->bonifica_rebaja);
		$criteria->compare('valor',$this->valor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Analisis the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
