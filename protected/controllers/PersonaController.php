<?php
class PersonaController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';
	/**
	* Parametros - Data4
	*/
	public $parametros = array();
	/**
	* @return array action filters
	*/
	public function filters()
	{
	return array(
	 'accessControl', // perform access control for CRUD operations
	);
	}
	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'roles'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','importar'),
				'roles'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
			'actions'=>array('admin','delete'),
			'roles'=>array('admin'),
			),
			array('deny',  // deny all users
			'users'=>array('*'),
			),
		);
	}
	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate($id_usuario=null)
	{
		$model=new Persona;
		if($id_usuario)
			$model->id_usuario=$id_usuario;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Persona'])){
			$model->attributes=$_POST['Persona'];
			$newDate = date("Y-m-d", strtotime($model->fecha_nac));			
			$model->fecha_nac=$newDate;
			if($model->save())
			$this->redirect(array('view','id'=>$model->id));
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Persona'])){
			$model->attributes=$_POST['Persona'];
			$newDate = date("Y-m-d", strtotime($model->fecha_nac));			
			$model->fecha_nac=$newDate;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		$model->fecha_nac = date("d-m-Y", strtotime($model->fecha_nac));
		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Persona');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Persona('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Persona']))
			$model->attributes=$_GET['Persona'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=Persona::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	* Performs the AJAX validation.
	* @param CModel the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='persona-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/* 
		El siguiente metodo importa de csv a la tabla.
	*/
	/*
	Importar datos de txt o csv
	*/
	public function actionImportar()
	{
	
		$model=new ImportarForm();
		$reg=0;
	  	if(isset($_POST["archivo"])){	  		
	       $model->attributes = $_POST["archivo"];	       
	       if(count(CUploadedFile::getInstancesByName('archivo'))>0){
	       	//$model->archivo = (isset(CUploadedFile::getInstancesByName('archivo')[0])?CUploadedFile::getInstancesByName('archivo')[0]:null);       
	       	$archivos=CUploadedFile::getInstancesByName('archivo');
	       	$model->archivo = $archivos[0];
	   	   }else{
	   	   	$model->archivo = null;
	   	   }
	       
	       if($model->validate()){ 
	       	// aqui entra CFileValidator
	          //$filename = sys_get_temp_dir().'/'.$model->archivo->getName();
	          $model->archivo->saveAs($model->archivo->getName());	          
	          //$arch= fopen($model->archivo->getName(), 'r');
	          // trunco el archivo en mas chicos para agilizar la carga
	          require_once(dirname(__FILE__).'/SiteController.php');
	          $archivos_generados=SiteController::truncarArchivo($model->archivo->getName());
	          unlink($model->archivo->getName());/* borro el archivo original */
	          // arreglo con errores de importación
	          $errores=array();
	          foreach ($archivos_generados as  $nom_arch) {
	          	$arch= fopen($nom_arch, 'r');
		          if(!feof($arch)){fgets($arch,4096);}
		          while(!feof($arch)){
		          	$linea = explode(';',fgets($arch,4096));
		          	//print_r($linea);	          	
		          	if(count($linea)>=2){
		          		$persona=Persona::model()->findByPk($linea[0]);	          	
			          	if($persona==null){	          		
			          		$persona = new Persona();
			          		$persona->id=$linea[0];
			          		$persona->nombre=$linea[1];
			          		$persona->apellido=' ';
			          		//lo pongo en blanco y veremos más adelante
			          		$persona->direccion=$linea[2].' '.$linea[3].' '.$linea[4].' '.$linea[5].' '.$linea[6];
			          		// busco la localidad  
			          		/*$loc = Localidad::model()->find('codigo_postal="'.$linea[8].'"');
			          		if(! $loc){								
			          			// creo la nueva localidad
			          			$loc = new Localidad();	
			          			$loc->nombre = ucwords(strtolower($linea[7]));
			          			$loc->codigo_postal = $linea[8];
			          			// busco la Provincia
			          			 $prov = Provincia::model()->find('nombre="'.Provincia::getNombreProvinciaSQL($linea[9]).'"');
			          			$loc->provincia = ($prov)?$prov->id:1;
			          			$loc->save();			          	
			          		}
			          		$persona->id_localidad= $loc->id;*/	
			          		$persona->localidad = ucwords(strtolower($linea[7]));
			          		$persona->codigo_postal = $linea[8];          		
			          		$persona->provincia =$linea[9];
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
			          		
			          	} else{
			          		// actualizo los datos del contribuyente
			          		$persona->nombre=$linea[1];
			          		$persona->apellido=' ';
			          		//lo pongo en blanco y veremos más adelante
			          		$persona->direccion=$linea[2].' '.$linea[3].' '.$linea[4].' '.$linea[5].' '.$linea[6];
			          		// busco la localidad  
			          		/*$loc = Localidad::model()->find('codigo_postal="'.$linea[8].'"');		          		
			          		if(! $loc){								
			          			// creo la nueva localidad
			          			$loc = new Localidad();	
			          			$loc->nombre = ucwords(strtolower($linea[7]));
			          			$loc->codigo_postal = $linea[8];
			          			// busco la Provincia
			          			 $prov = Provincia::model()->find('nombre="'.Provincia::getNombreProvinciaSQL($linea[9]).'"');
			          			$loc->provincia = ($prov)?$prov->id:1;
			          			$loc->save();			          	
			          		}	
			          		$persona->id_localidad= $loc->id;*/
			          		$persona->localidad = ucwords(strtolower($linea[7]));
			          		$persona->codigo_postal = $linea[8];          		
			          		$persona->provincia =$linea[9];
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
			          					$usuario->password=$usuario->hashPassword(trim($linea[12]));
			          					if(! $usuario->save()){
											Yii::log("Error reseteo pass usuario al importar: " . var_export($usuario->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
										}
			          				}
			          			}
			          		}
			          	}       		
		          	}
		          	
		          }	
		        fclose($arch);	
		        unlink($nom_arch);/* borro el archivo temporal q ya fue importado */          	
	          }/* end foreach*/        
	          Yii::app()->user->setFlash('success', "Se importaron ".$reg." registros nuevos.");  
	          	         
	       }
	    }
    
        $this->render('importar',array(
                    "model"=>$model,
                ));
	}
}
