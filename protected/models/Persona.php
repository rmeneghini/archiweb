<?php

/**
 * This is the model class for table "persona".
 *
 * The followings are the available columns in table 'persona':
 * @property integer $id
 * @property integer $dni
 * @property string $nombre
 * @property string $apellido
 * @property string $direccion
 * @property string $email
 * @property string $telefono_1
 * @property string $telefono_2
 * @property string $fecha_nac
 * @property integer $id_usuario
 * @property integer $id_localidad
 *
 * The followings are the available model relations:
 * @property Localidad $idLocalidad
 * @property Usuario $idUsuario
 */
class Persona extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'persona';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dni, nombre, apellido, direccion, email, telefono_1, id_localidad', 'required'),
			array('dni, id_usuario, id_localidad', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>100),
			array('apellido, email', 'length', 'max'=>80),
			array('direccion', 'length', 'max'=>120),
			array('telefono_1, telefono_2', 'length', 'max'=>25),
			array('fecha_nac','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dni, nombre, apellido, direccion, email, telefono_1, telefono_2, fecha_nac, id_usuario, id_localidad', 'safe', 'on'=>'search'),
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
			'idLocalidad' => array(self::BELONGS_TO, 'Localidad', 'id_localidad'),
			'idUsuario' => array(self::BELONGS_TO, 'Usuario', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dni' => 'Dni',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'direccion' => 'Dirección',
			'email' => 'Email',
			'telefono_1' => 'Telefono 1',
			'telefono_2' => 'Telefono 2',
			'fecha_nac' => 'Fecha Nac',
			'id_usuario' => 'Usuario',
			'id_localidad' => 'Localidad',
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
		$criteria->compare('dni',$this->dni);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefono_1',$this->telefono_1,true);
		$criteria->compare('telefono_2',$this->telefono_2,true);
		$criteria->compare('fecha_nac',$this->fecha_nac,true);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('id_localidad',$this->id_localidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Persona the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getPersona(){
	    return $this->nombre.', '.$this->apellido;
	}
	
}
