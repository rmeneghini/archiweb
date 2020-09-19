<?php
class UsuarioController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';
	/**
	* Parametros 
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
				'actions'=>array('create','update','asociar','eliminarEmp'),
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
	public function actionCreate()
	{
		$model=new Usuario;

		$empresas_asociadas = new UsuarioEmpresa('search');
		$empresas_asociadas->unsetAttributes();

		//empresas para listar
		$empresas = new Empresa('search');
		$empresas->unsetAttributes();
		if(isset($_GET['Empresa'])){
			$empresas->attributes=$_GET['Empresa'];	
		}


		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			$model->password=$model->hashPassword($model->password);
			$model->hash_activacion = md5($model->nombre."-activar");//este hash es para la activacion
			if($model->save()){
				// le asigno un rol								
                Yii::app()->authManager->assign($_POST['rol'],$model->id);                
				// compruebo si vienen los datos de las empresas
				if(isset($_POST['Usuario']['list-emp-json'])){
					$list_emp_json=json_decode($_POST['Usuario']['list-emp-json']);
					foreach ($list_emp_json as $emp_json) {
						$usuario_emp = new UsuarioEmpresa();
						$usuario_emp->usuario=$model->id;
						$usuario_emp->empresa = $emp_json->empresa;
						// falta recuperar el rol en el tribunal
						if(!$usuario_emp->save()){
							Yii::log("errors saving UsuarioEmpresa: " . var_export($usuario_emp->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
						}						
					}
				}
				// se agrego la siguiente línea para setear mensajes luego de cada acción
                Yii::app()->user->setFlash("success","Usuario creado con éxito.");
				// fin modificacion
                // si el rol es distinto de super creo una persona y pido que le llenen sus datos
                if($_POST['rol']!='super'){
            	   	/*$persona = new Persona;
                   	$persona->id_usuario=$model->id;*/
                  	$this->redirect(array('persona/create','id_usuario'=>$model->id));
                }else{
					$this->redirect(array('view','id'=>$model->id));
				}
            }
		}
		$this->render('create',array(
			'model'=>$model,
			'rol'=>'user',
			'empresas_asociadas'=>$empresas_asociadas,
			'empresas'=>$empresas,
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
		$passwordActual=$model->password;

		//recupero las empresas asociadas
		$empresas_asociadas=UsuarioEmpresa::model()->findAll('usuario = '.$id);
		
		//empresas para listar
		$empresas = new Empresa('search');
		$empresas->unsetAttributes();
		if(isset($_GET['Empresa'])){
			$empresas->attributes=$_GET['Empresa'];	
		}


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		// recupero los roles del usuario que no debería ser más de uno
		$roles=Yii::app()->authManager->getAuthAssignments($id);		
		$rol=key($roles);
		//print_r(isset($_POST['Usuario'])?"SI":"NO");
			
		if(isset($_POST['Usuario']))
		{			
			$model->attributes=$_POST['Usuario'];
			//compruebo si el password es distinto lo actualizo
			if($model->hashPassword($model->password)!=$model->hashPassword($passwordActual)){
				$model->password=$model->hashPassword($model->password);
			}else{
				$model->password=$passwordActual;
			}
			$model->hash_activacion = md5($model->nombre."-activar");//este hash es para la activacion
			if($model->save()){
				// le quito el rol que tenia y agrego el nuevo seleccionado
				if($rol){
					if(Yii::app()->authManager->checkAccess($rol,$id)){
                     Yii::app()->authManager->revoke($rol,$id);
                 	} 
				}
				 if(!Yii::app()->authManager->checkAccess($_POST['rol'],$model->id)){
                     Yii::app()->authManager->assign($_POST['rol'],$model->id);
				 }
				 // compruebo si vienen los datos de las empresas
				if(isset($_POST['Usuario']['list-emp-json'])){
					// borro lo que exista y vuelvo a insertar
					foreach ($empresas_asociadas as $empresaDel) {
						$empresaDel->delete();
					}
					$list_emp_json=json_decode($_POST['Usuario']['list-emp-json']);
					foreach ($list_emp_json as $emp_json) {
						$usuario_emp = new UsuarioEmpresa();
						$usuario_emp->usuario=$model->id;
						$usuario_emp->empresa = $emp_json->empresa;
						// falta recuperar el rol en el tribunal
						if(!$usuario_emp->save()){
							Yii::log("errors saving UsuarioEmpresa: " . var_export($usuario_emp->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
						}						
					}
				}
                 // se agrego la siguiente línea para setear mensajes luego de cada acción
                 Yii::app()->user->setFlash("success","Usuario actualizado con éxito.");
                 // fin modificacion
				$this->redirect(array('view','id'=>$model->id));
                        }
		}
		$this->render('update',array(
			'model'=>$model,
			'rol'=>$rol,
			'empresas_asociadas'=>$empresas_asociadas,
			'empresas'=>$empresas,
		));
	}
	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		//borro el rol
		$roles=Yii::app()->authManager->getAuthAssignments($id);		
		$rol=key($roles);
		if($rol){
					if(Yii::app()->authManager->checkAccess($rol,$id)){
                     Yii::app()->authManager->revoke($rol,$id);
                 	} 
				}
		// borro datos persona si tiene
		$persona= Persona::model()->find("id_usuario=".$id);		
		if($persona)
			$persona->delete();		
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];
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
		$model=Usuario::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/* Este metodo asocia una persona con un usuario */
	public function actionAsociar($persona, $usuario_id=null)
	{
		//compruebo que ya no exista en dicho caso lo redirecciono al editar
		if($usuario_id){
			$this->redirect(array('update','id'=>$usuario_id));
		}else{
			$model=new Usuario;	
		}
		
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			$model->password=$model->hashPassword($model->password);
			$model->hash_activacion = md5($model->nombre."-activar");//este hash es para la activacion
			if($model->save()){
				//asocioa la persona
				$obj_persona= Persona::model()->findByPk($_POST['persona-asociar']);
				$obj_persona->id_usuario=$model->id;
				$obj_persona->update();
				// le asigno un rol								
                Yii::app()->authManager->assign($_POST['rol'],$model->id);
                // se agrego la siguiente línea para setear mensajes luego de cada acción
                Yii::app()->user->setFlash("success","Usuario creado y asociado con éxito.");
                // fin modificacion
                $this->redirect(array('persona/view','id'=>$obj_persona->id));
				
            }
		}
		$this->render('asociar',array(
			'model'=>$model,
			'rol'=>'cliente',
			'persona'=>$persona,			
		));
	}

	//elimino la asociacion usuario-empresa
    public function actionEliminarEmp($usuario,$empresa) {
		header("Content-type: application/json"); // para que devuelva mime json, jquery lo agradece.
		 UsuarioEmpresa::model()->findByPk(array('usuario'=>$usuario,'empresa'=>$empresa))->delete();
		echo CJSON::encode("OK");
	}
}
