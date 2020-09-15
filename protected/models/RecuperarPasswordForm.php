<?php

/**
 * Modelo del formulario de recupero de password
 */
class RecuperarPasswordForm extends CFormModel
{
	public $email;	
	

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email', 'required'),
            array('email', 'comprobar_email'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Email',
		);
	}

	public function comprobar_email($attributes,$params) {
            $usuario=Usuario::model()->find('email=?',array($this->email));            
            if(!$usuario) {
                $this->addError('email', 'El email ingresado no se encuentra registrado en el sistema.');                
            }
        }
        
        

}
