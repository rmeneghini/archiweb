<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $id
 * @property string $descripcion
 * @property integer $lleva_grado
 * @property string $conf_import1
 * @property string $conf_import2
 * @property string $conf_import3
 *
 * The followings are the available model relations:
 * @property Analisis[] $analisises
 * @property Descargas[] $descargases
 * @property MermasHumedad[] $mermasHumedads
 * @property Rubro[] $rubros
 */
class Producto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, descripcion, lleva_grado', 'required'),
			array('id', 'unique'),
			array('lleva_grado', 'numerical', 'integerOnly' => true),
			array('descripcion', 'length', 'max' => 110),
			array('conf_import1, conf_import2, conf_import3', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, descripcion, lleva_grado, conf_import1, conf_import2, conf_import3', 'safe', 'on' => 'search'),
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
			'analisises' => array(self::HAS_MANY, 'Analisis', 'producto'),
			'descargases' => array(self::HAS_MANY, 'Descargas', 'producto'),
			'mermasHumedads' => array(self::HAS_MANY, 'MermasHumedad', 'producto'),
			'rubros' => array(self::MANY_MANY, 'Rubro', 'rubro_calculo_valor(producto, rubro)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID / COD',
			'descripcion' => 'Descripción',
			'lleva_grado' => 'Lleva Grado',
			'conf_import1' => 'Conf Importación 1',
            'conf_import2' => 'Conf Importación 2',
            'conf_import3' => 'Conf Importación 3',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('descripcion', $this->descripcion, true);
		$criteria->compare('lleva_grado', $this->lleva_grado);
		$criteria->compare('conf_import1',$this->conf_import1,true);
        $criteria->compare('conf_import2',$this->conf_import2,true);
        $criteria->compare('conf_import3',$this->conf_import3,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}


	public function getProducto()
	{
		return $this->descripcion . ' (' . $this->id . ')';
	}

	public static function getProductos($clave)
	{
		return  CHtml::listData(Producto::model()->findAll(), $clave, function ($prod) {
			return CHtml::encode($prod->descripcion . ' (' . $prod->id . ')');
		});
	}


	// Devuelve las calidad a mostrar en el select de la carga manual, esto deberia estar por DB 
	public static function getAnalisisCalidad($prod='15')
	{
		$prodCal = array(
			'15' => array(
				"CO" => "Conforme",
				"G1" => "Grado 1",
				"G2" => "Grado 2",
				"G3" => "Grado 3",
				"CC" => "Condión Cámara",
				"FE" => "Fuera de Estandar"
			),
			'16' => array(
				"CO" => "Conforme",
				"G1" => "Grado 1",
				"G2" => "Grado 2",
				"G3" => "Grado 3",
				"CC" => "Condión Cámara",
				"FE" => "Fuera de Estandar"
			),
			'22' => array(
				"CO" => "Conforme",
				"G1" => "Grado 1",
				"G2" => "Grado 2",
				"G3" => "Grado 3",
				"CC" => "Condión Cámara",
				"FE" => "Fuera de Estandar"
			),
			'23' => array(
				"CO" => "Conforme",
				"CC" => "Condión Cámara",
				"FE" => "Fuera de Estandar"
			),
		);

		return  $prodCal[$prod];
	}
}
