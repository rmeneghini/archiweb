<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
		$username=strtolower($this->username);
		// aca deber�a agregar la condici�n de activo
		 $user=Usuario::model()->find('LOWER(nombre)=? and estado=1',array($username));
		 if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		 else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		 else
		 {
			$this->_id=$user->id;
			$this->username=$user->nombre;                       
                        //si el estado es 0 le muestro un cartel avisando que debe completar sus datos sino se bloqueará
                       /* if($user->estado==0 && !isset($_GET['act']))
                            Yii::app()->user->setFlash("warning","Debe completar sus datos personales sino su cuenta será deshabilitada.<br>
                                ".CHtml::link('Completar',array('site/completarRegistro','act'=>$user->hash_activacion)));*/
			$this->errorCode=self::ERROR_NONE;
		 }
	return $this->errorCode==self::ERROR_NONE;
	}
 
 
	
	public function getId()
	{
	 return $this->_id;
	}
}