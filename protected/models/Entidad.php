<?php

/**
 * This is the model class for table "entidad".
 *
 * The followings are the available columns in table 'entidad':
 * @property integer $id
 * @property string $cuit
 * @property integer $tipo_entidad
 * @property integer $exportar
 * @property string $razonSocial
 * @property string $direccion
 *
 * The followings are the available model relations:
 * @property TipoEntidad $tipoEntidad
 */
class Entidad extends CActiveRecord
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuit, tipo_entidad, razonSocial, direccion', 'required'),
			array('tipo_entidad, exportar', 'numerical', 'integerOnly'=>true),
			array('cuit', 'length', 'max'=>12),
			//array('cuit', 'unique', 'message' => 'CUIT ya ingresado al sistema'),
			array('razonSocial, direccion', 'length', 'max'=>110),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cuit, tipo_entidad, exportar, razonSocial, direccion', 'safe', 'on'=>'search'),
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
			'tipoEntidad' => array(self::BELONGS_TO, 'TipoEntidad', 'tipo_entidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cuit' => 'Cuit',
			'tipo_entidad' => 'Tipo Entidad',
			'exportar' => 'Exportar',
			'razonSocial' => 'Razón Social',
			'direccion' => 'Dirección',
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
	public function search($tipo=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array('tipoEntidad');

		$criteria->compare('id',$this->id);
		$criteria->compare('cuit',$this->cuit,true);
		//Yii::log(" - PASO GET - ".var_export($_GET,true), CLogger::LEVEL_WARNING, __METHOD__);
		//Yii::log(" - PASO THIS - ".var_export($this->razonSocial,true), CLogger::LEVEL_WARNING, __METHOD__);
		if($tipo){			
			$criteria->compare('tipoEntidad.descripcion',$tipo);

		}else{
			$criteria->compare('tipo_entidad',$this->tipo_entidad);
		}
		$criteria->compare('exportar',$this->exportar);
		$criteria->compare('razonSocial',$this->razonSocial,true);
		$criteria->compare('direccion',$this->direccion,true);

		$dataProvider = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
		//Yii::log(" - PASO GET - ".var_export($dataProvider->id,true), CLogger::LEVEL_WARNING, __METHOD__);
		return $dataProvider;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
