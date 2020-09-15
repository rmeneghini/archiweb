<?php
class AdministradorController extends Controller
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
				'actions'=>array('index','view','cuentas'),
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
	* Lists all models.
	*/
	public function actionIndex()
	{
		// muestra la pantalla principal para el usuario administrador, recupero los cedulones que tengan igual id de nro de cedulon
		// son todos los que se debe solicitar la generación de cod de barras a pago facil
		$dataProvider=new CActiveDataProvider('Cedulon',array('criteria'=>array('condition'=>'id <> nro_cedulon')));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/* Lista las cuentas del contribuyente para la tasa seleccionada */
	public function actionCuentas($tasa)
	{
		// obtengo la persona relacionada con el usuario logueado
		$persona= Persona::model()->find('id_usuario='.Yii::app()->user->id);
		if($persona)
			$contribuyente=$persona->id;
		else
			$contribuyente=null;
		
		if(isset($contribuyente)){						
			
			/*$criteria = new CDbCriteria();
			$criteria->select = 't.*, SUM(`cuota`.`importe`) as `importe_total`,COUNT(`cuota`.`id`) as `cantidad_cuotas`'; 
			$criteria->join = ' INNER JOIN `cuota` ON t.nro = cuota.id_cuenta';
			$criteria->condition = 't.id_persona = :contribuyente AND cuota.tasa= :tasa';
			$criteria->params = array(':contribuyente'=>$contribuyente,':tasa'=>$tasa);
			$criteria->group = 't.nro HAVING count(cuota.id) > 0';
			//$criteria->together = true;
			$dataProvider=new CActiveDataProvider('Cuenta',array('criteria'=>$criteria));*/
			$ctas = Yii::app()->db->createCommand()
        	->select('t.*, SUM(`cuota`.`importe`) as `importe_total`,COUNT(`cuota`.`id`) as `cantidad_cuotas`')
        	->from('cuenta t')
        	->join('cuota','t.nro = cuota.id_cuenta')
        	->where('t.id_persona = :contribuyente AND cuota.tasa= :tasa',array(':contribuyente'=>$contribuyente,':tasa'=>$tasa))
        	->group('t.nro HAVING count(cuota.id) > 0')
        	->queryAll();
        	$dataProvider=new CArrayDataProvider($ctas, array('id'=>'nro','pagination'=>array('pageSize'=>10,)));/*
			----
			SELECT a.nro, SUM(b.importe) AS Total FROM (`cuenta` as a INNER JOIN `cuota` as b ON a.nro = b.id_cuenta) GROUP BY a.nro HAVING count(b.id) > 0
			*/
			/*$criteria=new CDbCriteria;
			$criteria->compare('id_persona', $contribuyente, false); 
			$dataProvider=new CActiveDataProvider('Cuenta',array('criteria'=>$criteria));*/
			$contribuyente= Persona::model()->findByPk($contribuyente);
		}else{
			$dataProvider=new CActiveDataProvider('Cuenta');
		}
		$this->render('cuentas',array(
			'dataProvider'=>$dataProvider,
			'contribuyente'=>$contribuyente,
			'tasa'=>$tasa,
		));
	}
	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Cedulon('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Cedulon']))
			$model->attributes=$_GET['Cedulon'];
		if(isset($_GET['export']) && $_GET['export']=='grilla'){
				// marco como exportado
				$contenido= $this->renderPartial('excel',array('dataProvider'=>Yii::app()->user->getState('export'),),true);
				Yii::app()->request->sendFile('exportExcel.xls',$contenido);
    			Yii::app()->user->clearState('export');		
		}else if(isset($_GET['export']) && $_GET['export']=='csv'){
				// marco como exportado	
			$conf =  Configuracion::singleton();
			$configuracion = $conf->getAll();
				$delimitador = $configuracion['delimitador-csv'];					
				$contenido= $this->renderPartial('csv',array('dataProvider'=>Yii::app()->user->getState('export'),'delimitador'=>$delimitador),true);
				Yii::app()->request->sendFile('exportCSV.csv',Yii::app()->user->getState('exportCSV'));
    			Yii::app()->user->clearState('exportCSV');		
			}
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
		$model=Tasa::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tasa-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
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
	       
	       if($model->validate()){ // aqui entra CFileValidator
	          //$filename = sys_get_temp_dir().'/'.$model->archivo->getName();
	          $model->archivo->saveAs($model->archivo->getName());	          
	          $arch= fopen($model->archivo->getName(), 'r');
	          if(!feof($arch)){fgets($arch,4096);
	          //salto los titulos
	          }
	          while(!feof($arch)){
	          	$linea = explode(Yii::app()->params['importar']['separador'],fgets($arch,4096));
	          	//print_r($linea);	          	
	          	if(count($linea)>=2){
	          		$tasa=Tasa::model()->find("codigo='".$linea[0]."'");	          	
		          	if($tasa==null){	          		
		          		$tasa = new Tasa();
		          		$tasa->codigo=$linea[0];
		          		$tasa->nombre=$linea[1];
		          		$tasa->save();
		          		$reg++;
		          	}        		
	          	}
	          	
	          }	        
	          Yii::app()->user->setFlash('success', "Se importaron ".$reg." registros nuevos.");  
	          fclose($arch);
	          unlink($model->archivo->getName());	         
	       }
	    }
    
        $this->render('importar',array(
                    "model"=>$model,
                ));
	}
}
