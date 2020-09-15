<?php

/**
 * This is the model class for table "mermas_humedad".
 *
 * The followings are the available columns in table 'mermas_humedad':
 * @property integer $producto
 * @property double $porcentaje_humedad
 * @property double $valor
 *
 * The followings are the available model relations:
 * @property Producto $producto0
 */
class MermasHumedad extends CActiveRecord
{
	public $porcentaje_min;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mermas_humedad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto, porcentaje_humedad, valor', 'required'),
			array('producto', 'numerical', 'integerOnly'=>true),
			array('porcentaje_humedad, valor', 'numerical','integerOnly'=>false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('producto, porcentaje_humedad, valor', 'safe', 'on'=>'search'),
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
			'productos' => array(self::BELONGS_TO, 'Producto', 'producto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'producto' => 'Producto',
			'porcentaje_humedad' => 'Porcentaje Humedad',
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

		$criteria->compare('producto',$this->producto);
		$criteria->compare('porcentaje_humedad',$this->porcentaje_humedad);
		$criteria->compare('valor',$this->valor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MermasHumedad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	// retorno los % min de humedad por producto
	public static function getPorcentajesMin(){
		$criteria = new CDbCriteria;
		$criteria->select='producto, min(porcentaje_humedad) as `porcentaje_min`';		
		$criteria->group= 'producto';
		return CHtml::listData(MermasHumedad::model()->findAll($criteria),'producto','porcentaje_min');		
	}
}
