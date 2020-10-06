<?php
class SiteController extends Controller
{
	/**
	* Parametros
	*/
	public $parametros = array();
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('contact','error','login','logout','registro','page','captcha','recuperarPassword'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','completarRegistro','cambiarPassword'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('importar'),
				'roles'=>array('admin'),
			),                  
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(Yii::app()->user->isGuest){
			$this->actionLogin();
		}else{
			$this->render('index');
		}
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: ".CHtml::encode(Yii::app()->name)." <info@".$_SERVER['HTTP_HOST'].">"."\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Gracias por contactarnos.Responderemos a la mayor brevedad posible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect($this->createUrl('descargas/admin'));
				// segun el rol lo redirecciono
				/*if(!Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)){
					$this->redirect($this->createUrl('descargas/admin'));
				}else{
					$this->redirect($this->createUrl('descargas/admin'));
					//$this->redirect(Yii::app()->user->returnUrl);
				}*/
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public static function enviarMail($dir_correo_destino,$asunto, $cuerpo)
	{      
		//para el envío en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		//dirección del remitente
		$headers .= "From: ".CHtml::encode(Yii::app()->name)." <info@".$_SERVER['HTTP_HOST'].">"."\r\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: no-reply@".$_SERVER['HTTP_HOST']." \r\n";
		//direcciones que recibián copia
		//$headers .= "Cc: correocopia@dominio.com\r\n";
		//direcciones que recibirán copia oculta
		//$headers .= "Bcc: copiaocula1@dominio.com, copiaocula1@dominio.com \r\n";
		mail($dir_correo_destino,$asunto,$cuerpo,$headers);
	}
	/* Funcion encargada de recuperar el password */
	public function actionRecuperarPassword()
	{
		$model=new RecuperarPasswordForm();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				if(isset($_POST['ajax']) && $_POST['ajax']==='recuperar-form'){
					echo CActiveForm::validate($model);
					Yii::app()->end();
				}
				
		if(isset($_POST['RecuperarPasswordForm']))
		{
			//$model->attributes=$_POST['Registro'];
			/* Genero el pass y el codigo de activaci�n */          
			
								// busco el usuario por el mail y le regenero un password
								$usuario = Usuario::model()->find('email=?',array($_POST['RecuperarPasswordForm']['email']));
								$nuevo_pass =substr( md5(microtime()), 1, 8);
								$usuario->password = $usuario->hashPassword($nuevo_pass);
								$usuario->hash_activacion = md5($usuario->email."-activar");//este hash es para la activacion
								$usuario->update();
								// envio el mail con la nueva clave
								 $cuerpo = '
									'.CHtml::encode(Yii::app()->name).' - Recuperación de contraseña
									<h1>Recuperación</h1>
									La nueva contraseña es <strong>'.CHtml::encode($nuevo_pass).'</strong>';
								 $this->enviarMail($usuario->email, 'Recuperación de contraseña', $cuerpo);
								/**/
								Yii::app()->user->setFlash("success","Se le enviará un mail con la nueva contraseña.");
				
						
		}
		$this->render('recuperarPassword',array(
			'model'=>$model,
		));
	}
	/* Funcion encargada de cambiar password */
	public function actionCambiarPassword()
	{
		$model=new CambiarPasswordForm();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				if(isset($_POST['ajax']) && $_POST['ajax']==='cambiar-password-form'){
					echo CActiveForm::validate($model);
					Yii::app()->end();
				}
				
		if(isset($_POST['CambiarPasswordForm']))
		{           
			$usuario=Usuario::model()->findByPk(Yii::app()->user->id);
			$usuario->password = $usuario->hashPassword($_POST['CambiarPasswordForm']['password_nuevo']);            
			$usuario->update();
			Yii::app()->user->setFlash("success","Se ha cambiado la contraseña con éxito.");
		}
		$this->render('cambiarPassword',array(
			'model'=>$model,
		));
	}
	/* wizard importación */
	public function actionImportar()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$tabActivo='contribuyentes';
		$model=new ImportarForm();
		$reg=0;
		$archivos=CUploadedFile::getInstancesByName('archivo');
		if((count($archivos)>0) or (isset($_POST["ImportarForm"]["archivos_subidos"]) and $_POST["ImportarForm"]["archivos_subidos"]==1)){
		   $model->attributes = $_POST["archivo"];
		   if(count($archivos)>0){
			$model->archivo = $archivos[0];
		   }else{
			$model->archivo = null;
		   }
		   if($model->validate()){
			// aqui entra CFileValidator
			  //$filename = sys_get_temp_dir().'/'.$model->archivo->getName();
			if(isset($_POST["ImportarForm"]["archivos_subidos"]) and $_POST["ImportarForm"]["archivos_subidos"]==1){
				//recupero los archivos que esten en la carpeta temporal y los importo
				$archivos_generados= $this->showFiles();
			}else{
			  $model->archivo->saveAs($model->archivo->getName());
			  // trunco el archivo en mas chicos para agilizar la carga
			  $archivos_generados=$this->truncarArchivo($model->archivo->getName());
			  unlink($model->archivo->getName());/* borro el archivo original */
			}
			$errores=array();
			foreach ($archivos_generados as  $nom_arch) {
				$arch= fopen($nom_arch, 'r');
				if(!feof($arch)){fgets($arch,4096);}
				while(!feof($arch)){
					$linea = explode(';',fgets($arch,4096));
					if(count($linea)>=2){
						if($_POST["formulario"]=='persona-form'){
							/**********************/
							/*   CONTRIBUENTES    */
							/**********************/
							$tabActivo='contribuyentes';
							$persona=Persona::model()->findByPk($linea[0]);
							if($persona==null){
								$persona                = new Persona();
								$persona->id            =$linea[0];
								$persona->nombre        =$linea[1];
								$persona->apellido      =' ';
								$persona->direccion     =$linea[2].' '.$linea[3].' '.$linea[4].' '.$linea[5].' '.$linea[6];
								$persona->localidad     =ucwords(strtolower($linea[7]));
								$persona->codigo_postal = $linea[8];
								$persona->provincia     =$linea[9];
								set_time_limit(2);// agrego 2 segundo al tiempo limite de ejecucion de query
								if($persona->save()){
									$reg++;
									//Compruebo si el contribuyente tiene usuario generado
									if(isset($linea[11]) && $linea[11]>''){
										$usuario = Usuario::model()->find('nombre = :usr',array(':usr'=>Usuario::sanear_string($linea[11])));
										if($usuario==null){
											//lo creo
											$usuario= new Usuario();
											$usuario->nombre=Usuario::sanear_string($linea[11]);
											$usuario->password=$usuario->hashPassword(trim($linea[12]));
											$usuario->hash_activacion = md5($usuario->nombre."-activar");//este hash es para la activacion
											$usuario->estado=1;
											if(! $usuario->save()){
												Yii::log("Error Creación usuario al importar: " . var_export($usuario->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
											}else{
												// asigno el rol
												Yii::app()->authManager->assign('cliente',$usuario->id);
												// asocio la persona con el usuario
												$persona->id_usuario=$usuario->id;
												$persona->update();
											}
										}else{
											// le reseteo el password
											$usuario->password=$usuario->hashPassword($linea[12]);                                      
											if(! $usuario->save()){
												Yii::log("Error reseteo pass usuario al importar: " . var_export($usuario->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
											}
										}
									}
								}
							}else{
								// actualizo los datos del contribuyente
								$persona->nombre=$linea[1];
								$persona->apellido=' ';
								//lo pongo en blanco y veremos más adelante
								$persona->direccion=$linea[2].' '.$linea[3].' '.$linea[4].' '.$linea[5].' '.$linea[6];
								$persona->localidad=ucwords(strtolower($linea[7]));
								$persona->codigo_postal = $linea[8];
								$persona->provincia =$linea[9];
								set_time_limit(2);// agrego 2 segundo al tiempo limite de ejecucion de query
								if($persona->save()){
									$reg++;
									//Compruebo si el contribuyente tiene usuario generado
									if(isset($linea[11]) && $linea[11] > '' ){
					          			// search user by id to update the same row
										$usuario = Usuario::model()->find('id = :id',array(':id'=> $persona->id_usuario));
										if($usuario==null){
											//lo creo
											$usuario= new Usuario();
											$usuario->nombre=Usuario::sanear_string($linea[11]);
											$usuario->password=$usuario->hashPassword(trim($linea[12]));
											$usuario->hash_activacion = md5($usuario->nombre."-activar");//este hash es para la activacion
											$usuario->estado=1;
											if(! $usuario->save()){
												Yii::log("Error Creación usuario al importar: " . var_export($usuario->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
											}else{
												// asigno el rol
												Yii::app()->authManager->assign('cliente',$usuario->id);
												// asocio la persona con el usuario
												$persona->id_usuario=$usuario->id;
												$persona->update();
											}
										}else{
											// reset username
											$usuario->nombre          =trim($linea[11]);
											// reset password
											$usuario->password        =$usuario->hashPassword(trim($linea[12]));
											$usuario->hash_activacion = md5(trim($linea[11])."-activar");//este hash es para la activacion
											$usuario->estado          =1;
											if(! $usuario->save()){
												Yii::log("Error reseteo pass usuario al importar: " . var_export($usuario->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
											}
										}
									}
								}else{
									Yii::log("Error actualizar persona al importar: Loc(".$linea[8].")" . var_export($persona->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
								}
							}
						}
					}
			  }  /* end while */
				fclose($arch);
				unlink($nom_arch);/* borro el archivo temporal q ya fue importado */
			  }/* end foreach*/
			  Yii::app()->user->setFlash('success', "Se importaron ".$reg." registros nuevos.");
			  // save in runtime folder
			  if(!empty($importoOk)) {
			  	Yii::log("### Ctas importadas: " . var_export($importoOk, true), CLogger::LEVEL_WARNING, __METHOD__);
			  }
			  if (!empty($actualizoOk)) {
			  	Yii::log("### Ctas actualizadas: " . var_export($actualizoOk, true), CLogger::LEVEL_WARNING, __METHOD__);
			  }
		   }
		}
		$this->render('importar',array('model'=>$model,'tabActivo'=>$tabActivo));
	}
	public  static function truncarArchivo($to_read,$size = 70000,$directory_temp='archivosTemp/'){
		//70000 equivale a 70Kb 
		/**
		* Split a CSV file
		*
		* Each row is its own line.
		* Each cell is comma-separated
		* This file splits it into piece of size $size, add the header row
		* and names the resulting file filename_X.csv where filename is the
		* name of the original file and X is an incrementing integer.
		*/
		 
		// Do not edit
		$done = false;
		$part = -1;
		$files_result = array();
		//print_r($to_read);exit();
		if (($handle = fopen($to_read, "r")) !== FALSE) {
			$header = fgets($handle);
			$part = 0;
			while ($done == false) {
				$locA = ftell($handle); // gets the current location. START
				fseek($handle, $size, SEEK_CUR); // jump the length of $size from current position
				$tmp = fgets($handle); // read to the end of line. We want full lines
				$locB = ftell($handle); // gets the current location. END
				$span = ($locB - $locA);
				fseek($handle, $locA, SEEK_SET); // jump to the START of this chunk
				$chunk = fread($handle,$span); // read the chunk between START and END
				file_put_contents($directory_temp.$to_read.'_'.$part.'.csv',$header.$chunk);
				$files_result[] = $directory_temp.$to_read.'_'.$part.'.csv';            
				$part++;
				if (strlen($chunk) < $size) $done = true;
			}
			fclose($handle);
		}
		return $files_result;
	}
	public  static function formatearFecha($fechaString){
		// Esta funcion espera DD/MM/YY y retorna YY/MM/DD
		$fecha = date_create_from_format('j/n/Y', $fechaString);
		$result=date_format($fecha, 'y/m/d');
		return $result;
	}
	public  static function showFiles($path='archivosTemp/'){
		$dir = opendir($path);
		$files = array();
		while ($current = readdir($dir)){
			if( $current != "." && $current != "..") {
				if(is_dir($path.$current)) {
					SiteController::showFiles($path.$current.'/');
				}
				else {
					$files[] = $path.$current;
				}
			}
		}
		return $files;
	}
	
}