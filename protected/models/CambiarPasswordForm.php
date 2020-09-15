<?php

/**
 * Modelo del formulario de cambio de password
 */
class CambiarPasswordForm extends CFormModel
{
	public $password_actual;	
	public $password_nuevo;	
	public $repetir_password;	
	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('password_actual,password_nuevo,repetir_password', 'required'),			
            array('repetir_password', 'compare','compareAttribute'=>'password_nuevo','message'=>'La contraseña no coincide'),
            array('password_actual', 'comprobar_password'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password_actual'=>'Contraseña actual',
			'password_nuevo'=>'Nueva contraseña',
            'repetir_password'=>'Repetir contraseña',
		);
	}

	// valido q el password actual sea el correcto
	public function comprobar_password($attributes,$params) {
            $usuario=Usuario::model()->findByPk(Yii::app()->user->id);            
            if($usuario->password != $usuario->hashPassword($this->password_actual)) {
                $this->addError('password_actual', 'La contraseña ingresada no coincide con la del sistema.');                
            }
        }
        
        

}
