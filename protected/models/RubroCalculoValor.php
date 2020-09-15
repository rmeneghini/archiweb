<?php

/**
 * This is the model class for table "rubro_calculo_valor".
 *
 * The followings are the available columns in table 'rubro_calculo_valor':
 * @property integer $producto
 * @property integer $rubro
 * @property double $valor_desde
 * @property double $valor_hasta
 * @property integer $diferencia_valor_hasta
 * @property integer $bonifica
 * @property double $castiga_bonifica
 * @property double $adicionar_a_castiga_bonifica
 */
class RubroCalculoValor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rubro_calculo_valor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto, rubro, valor_desde, valor_hasta, castiga_bonifica, adicionar_a_castiga_bonifica', 'required'),
			array('producto, rubro, diferencia_valor_hasta, bonifica', 'numerical', 'integerOnly'=>true),
			array('valor_desde, valor_hasta, castiga_bonifica, adicionar_a_castiga_bonifica', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('producto, rubro, valor_desde, valor_hasta, diferencia_valor_hasta, bonifica, castiga_bonifica, adicionar_a_castiga_bonifica', 'safe', 'on'=>'search'),
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
			'rubros' => array(self::BELONGS_TO, 'Rubro', 'rubro'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'producto' => 'Producto',
			'rubro' => 'Rubro',
			'valor_desde' => 'Valor Desde',
			'valor_hasta' => 'Valor Hasta',
			'diferencia_valor_hasta' => 'Diferencia Valor Hasta',
			'bonifica' => 'Bonifica',
			'castiga_bonifica' => 'Castiga Bonifica',
			'adicionar_a_castiga_bonifica' => 'Adicionar A Castiga Bonifica',
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
		$criteria->compare('rubro',$this->rubro);
		$criteria->compare('valor_desde',$this->valor_desde);
		$criteria->compare('valor_hasta',$this->valor_hasta);
		$criteria->compare('diferencia_valor_hasta',$this->diferencia_valor_hasta);
		$criteria->compare('bonifica',$this->bonifica);
		$criteria->compare('castiga_bonifica',$this->castiga_bonifica);
		$criteria->compare('adicionar_a_castiga_bonifica',$this->adicionar_a_castiga_bonifica);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RubroCalculoValor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
