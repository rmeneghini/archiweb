<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id
 * @property string $nombre
 * @property string $password
 * @property string $hash_activacion
 * @property integer $estado
 * @property integer $notificaciones
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, password', 'required'),
			array('estado, notificaciones', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>60),
			array('nombre', 'comprobar_nombre','on'=>'create'),
			array('password', 'length', 'max'=>100),
			array('hash_activacion', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, password, hash_activacion, estado, notificaciones', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
			'password' => 'Password',
			'hash_activacion' => 'Hash Activacion',
			'estado' => 'Estado',
			'notificaciones' => 'Notificaciones',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('hash_activacion',$this->hash_activacion,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('notificaciones',$this->notificaciones);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
	 return $this->hashPassword($password)===$this->password;
	}
	 
	public function hashPassword($password)
	{
	 return md5(Usuario::sanear_string_pass($password)."supersecreto");
	}

	/* uso este metodo para mostrar los datos de la persona asociada al usuario*/
	public function getPersona()
	{
	 $persona=Persona::model()->find("id_usuario = ".$this->id);
	 if($persona)
	 	return $persona->nombre.', '.$persona->apellido;
	 else
	 	return "Falta completar datos";
	}
	
	// esta funcion valida que el nombre de usuario no exista ya en el sistema
	public function comprobar_nombre($attributes,$params) {
		// primero compruebo que no tenga espacios en blanco ni caracteres raros
		if(!ereg("^[a-zA-Z0-9\-_]{3,20}$", $this->nombre)){
			$this->addError('nombre', 'El nombre de usuario no puede contener espacios blancos ni caracteres raros.');                
		}else{			
	        $usuario=Usuario::model()->find('nombre=?',array(strtolower($this->nombre)));            
	        if($usuario) {
	            $this->addError('nombre', 'El nombre de usuario ingresado ya se encuentra registrado en el sistema.');                
	        }
    	}
    }

    // elimina los caracteres indeseados
    public static function sanear_string($string) {
   		//setlocale(LC_ALL, 'en_US.UTF8');

	    $string = trim($string);

	    $string = str_replace(array('á','à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a','a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string );

	    $string = str_replace(array('é','è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e','e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);

	    $string = str_replace(array('í','ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i','i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);

	    $string = str_replace(array('ó','ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o','o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);

	    $string = str_replace(array('ú','ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u','u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);

	 	$string = str_replace(array('ç', 'Ç'),array('c', 'C'),$string);
	 	$string = str_replace(array('ñ', 'Ñ'),array('n', 'N'),$string);

	    //Esta parte se encarga de eliminar cualquier caracter extraño
	    $string = str_replace(array("\\", "¨", "º", "-", "~","#", "@", "|", "!", "\"","·", "$", "%", "&", "/","(", ")", "?", "'", "¡","¿", "[", "^", "`", "]","+", "}", "{", "¨", "´",">", "< ", ";", ",", ":","."),'',$string);
	    $string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
	    $charset='ISO-8859-1'; // o 'UTF-8'
		$string = iconv($charset, 'ASCII//TRANSLIT', $string);
	    return $string;
	}
	
	public static function sanear_string_pass($string) {
   		//setlocale(LC_ALL, 'en_US.UTF8');

	    $string = trim($string);

	    /*$string = str_replace(array('á','à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a','a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string );

	    $string = str_replace(array('é','è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e','e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);

	    $string = str_replace(array('í','ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i','i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);

	    $string = str_replace(array('ó','ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o','o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);

	    $string = str_replace(array('ú','ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u','u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);

	 	$string = str_replace(array('ç', 'Ç'),array('c', 'C'),$string);
	 	$string = str_replace(array('ñ', 'Ñ'),array('n', 'N'),$string);

	    //Esta parte se encarga de eliminar cualquier caracter extraño
	    $string = str_replace(array("\\", "¨", "º", "-", "~","#", "@", "|", "!", "\"","·", "$", "%", "&", "/","(", ")", "?", "'", "¡","¿", "[", "^", "`", "]","+", "}", "{", "¨", "´",">", "< ", ";", ",", ":","."),'',$string);
	    $string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);*/
	    $charset='ISO-8859-1'; // o 'UTF-8'
		$string = iconv($charset, 'ASCII//TRANSLIT', $string);
	    return $string;
	}
}
