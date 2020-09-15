<?php

/**
 * This is the model class for table "provincia".
 *
 * The followings are the available columns in table 'provincia':
 * @property integer $id
 * @property string $nombre
 * @property integer $pais
 *
 * The followings are the available model relations:
 * @property Liga[] $ligas
 * @property Localidad[] $localidads
 * @property Persona[] $personas
 * @property Pais $pais0
 */
class Provincia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'provincia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, pais', 'required'),
			array('pais', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>80),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, pais', 'safe', 'on'=>'search'),
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
			'ligas' => array(self::HAS_MANY, 'Liga', 'provincia'),
			'localidads' => array(self::HAS_MANY, 'Localidad', 'provincia'),
			'personas' => array(self::HAS_MANY, 'Persona', 'provincia'),
			'pais0' => array(self::BELONGS_TO, 'Pais', 'pais'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'pais' => 'Pais',
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
		$criteria->compare('t.nombre',$this->nombre,true);
		$criteria->with = array('pais0');
        $criteria->compare('pais0.nombre', $this->pais, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Provincia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public static function getProvincias($clave,$pais=null) {
		if(!isset($pais))
			$pais=Pais::model()->find('nombre=?',array(Yii::app()->params['paisDefault']));
        return  CHtml::listData(Provincia::model()->findAll('pais = :id_pais',array('id_pais'=>$pais->id)),$clave,'nombre');
    }

    public static function getNombreProvinciaSQL($nomProv){
    	//esta funcion devuelve el nombre de la provincia como esta en la base para que sea buscada sin acentos
    	$provincia = array(
					  'BUENOS AIRES' => 'Buenos Aires',
					  'CAPITAL FEDERAL' => 'Capital Federal',
					  'CATAMARCA' => 'Catamarca',
					  'CHACO' => 'Chaco',
					  'CHUBUT' => 'Chubut',
					  'CORDOBA' => 'Córdoba','CÓRDOBA' => 'Córdoba',
					  'CORRIENTES' => 'Corrientes',
					  'ENTRE RIOS' => 'Entre Ríos','ENTRE RÍOS' => 'Entre Ríos',
					  'FORMOSA' => 'Formosa',
					  'JUJUY' => 'Jujuy',
					  'LA PAMPA' => 'La Pampa',
					  'LA RIOJA' => 'La Rioja',
					  'MENDOZA' => 'Mendoza',
					  'MISIONES' => 'Misiones',
					  'NEUQUEN' => 'Neuquén','NEUQUÉN' => 'Neuquén',
					  'RIO NEGRO' => 'Río Negro','RÍO NEGRO' => 'Río Negro',
					  'SALTA' => 'Salta',
					  'SAN JUAN' => 'San Juan',
					  'SAN LUIS' => 'San Luis',
					  'SANTA CRUZ' => 'Santa Cruz',
					  'SANTA FE' => 'Santa Fe',
					  'SANTIAGO DEL ESTERO' => 'Santiago del Estero',
					  'TIERRA DEL FUEGO' => 'Tierra del Fuego',
					  'TUCUMAN' => 'Tucumán','TUCUMÁN' => 'Tucumán'
					);
    	return (array_key_exists(strtoupper(rtrim(ltrim($nomProv))),$provincia))?$provincia[strtoupper(rtrim(ltrim($nomProv)))]:'Buenos Aires';
    }
}
