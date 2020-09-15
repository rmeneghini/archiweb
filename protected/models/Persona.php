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
 * @property Cuenta[] $cuentas
 * @property DetalleCuenta[] $detalleCuentas
 * @property Localidad $idLocalidad
 
 * @property string $localidad
 * @property string $codigo_postal
 * @property string $provincia
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
			array('nombre', 'required'),
			//array('dni, id_usuario, id_localidad', 'numerical', 'integerOnly'=>true),
			array('dni, id_usuario', 'numerical', 'integerOnly'=>true),
			array('nombre,localidad', 'length', 'max'=>100),
			array('apellido', 'length', 'max'=>80),
			array('direccion', 'length', 'max'=>120),
			array('email', 'length', 'max'=>70),
			array('telefono_1, telefono_2', 'length', 'max'=>25),
			array('codigo_postal', 'length', 'max'=>10),
			array('provincia', 'length', 'max'=>90),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dni, nombre, apellido, direccion, email, telefono_1, telefono_2, fecha_nac, id_usuario, localidad, provincia', 'safe', 'on'=>'search'),
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
			'cuentas' => array(self::HAS_MANY, 'Cuenta', 'id_persona'),
			'detalleCuentas' => array(self::HAS_MANY, 'DetalleCuenta', 'id_persona'),
			/*'idLocalidad' => array(self::BELONGS_TO, 'Localidad', 'id_localidad'),*/
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
			'direccion' => 'Direccion',
			'email' => 'Email',
			'telefono_1' => 'Telefono 1',
			'telefono_2' => 'Telefono 2',
			'fecha_nac' => 'Fecha Nac',
			'id_usuario' => 'Id Usuario',
			'localidad' => 'Localidad',
			'provincia' => 'Provincia',
			'codigo_postal' => 'Cod Postal',
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
		$criteria->compare('localidad',$this->localidad,true);
		$criteria->compare('provincia',$this->provincia,true);
		$criteria->compare('codigo_postal',$this->codigo_postal,true);
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
