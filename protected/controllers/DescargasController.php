<?php
class DescargasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
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
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view','analisis'),
				'users' => array('@'),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update','importar','admin', 'delete'),
				'roles' => array('cliente'),
			),
			/*array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'roles' => array('cliente'),
			),*/			
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Descargas;

		$modelEntidadTitular = new Entidad('search');
		$modelEntidadTitular->unsetAttributes();
		$modelEntidadCorredor = new Entidad('search');
		$modelEntidadCorredor->unsetAttributes();
		$modelEntidadDestino = new Entidad('search');
		$modelEntidadDestino->unsetAttributes();
		
		if(isset($_GET['Entidad'])){
			if($_GET['ajax']=='entidad-grid-titular'){
				$modelEntidadTitular->attributes=$_GET['Entidad'];
			}else if($_GET['ajax']=='entidad-grid-corredor'){
				$modelEntidadCorredor->attributes=$_GET['Entidad'];
			}else  if($_GET['ajax']=='entidad-grid-destino'){
				$modelEntidadDestino->attributes=$_GET['Entidad'];
			}
			
			//Yii::log(" - PASO - ".var_export($modelEntidad->tipo_entidad,true), CLogger::LEVEL_WARNING, __METHOD__);
		}
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		if (isset($_POST['Descargas'])) {
			$model->attributes = $_POST['Descargas'];
			$model->usuario =  Yii::app()->user->id;
			// formateo las fechas
			$fecha = date("Y-m-d", strtotime($model->fecha_carga));
			$model->fecha_carga=$fecha;
			$fecha = date("Y-m-d", strtotime($model->fecha_arribo));
			$model->fecha_arribo=$fecha;
			$fecha = date("Y-m-d", strtotime($model->fecha_carta_porte));
			$model->fecha_carta_porte=$fecha;

			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}
		
		$model->fecha_carga = date("d/m/Y", strtotime($model->fecha_carga));
		$model->fecha_arribo = date("d/m/Y", strtotime($model->fecha_arribo));
		$model->fecha_carta_porte = date("d/m/Y", strtotime($model->fecha_carta_porte));
		$this->render('create', array(
			'model' => $model,			
			'modelEntidadTitular' => $modelEntidadTitular,
			'modelEntidadCorredor' => $modelEntidadCorredor,
			'modelEntidadDestino' => $modelEntidadDestino,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset($_POST['Descargas'])) {
			$model->attributes = $_POST['Descargas'];
			$model->usuario =  Yii::app()->user->id;
			// formateo las fechas
			$fecha = date("Y-m-d", strtotime($model->fecha_carga));
			$model->fecha_carga=$fecha;
			$fecha = date("Y-m-d", strtotime($model->fecha_arribo));
			$model->fecha_arribo=$fecha;
			$fecha = date("Y-m-d", strtotime($model->fecha_carta_porte));
			$model->fecha_carta_porte=$fecha;
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}
		$modelEntidad = new Entidad('search');
		// formateo fechas	
		$model->fecha_carga = date("d/m/Y", strtotime($model->fecha_carga));
		$model->fecha_arribo = date("d/m/Y", strtotime($model->fecha_arribo));
		$model->fecha_carta_porte = date("d/m/Y", strtotime($model->fecha_carta_porte));
		////////////
		$this->render('update', array(
			'model' => $model,
			'modelEntidad' => $modelEntidad,
			//'modelEntidadTitular' => $modelEntidadTitular,
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// segun el rol del usuario le permito ver datos
		$criteria = new CDbCriteria;
		if (!Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id)) {
			// si no tiene el rol de admin solo vera los que cargo
			$criteria->compare('usuario', Yii::app()->user->id, true);
		}
		$dataProvider = new CActiveDataProvider('Descargas', array('criteria' => $criteria));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout='//layouts/column1';

		

		$model = new Descargas('search');
		$model->unsetAttributes();  // clear any default values

		$filtro_empresas = null;
		// segun el rol del usuario le permito ver datos
		if (!Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id)) {
			// si no tiene el rol de admin solo vera los que cargo
			$model->usuario = Yii::app()->user->id;
		}else if (!Yii::app()->authManager->checkAccess('super', Yii::app()->user->id)) {
			// si es admin tenemos que filtrar por empresa
			$usuarioLog = Usuario::model()->findByPk(Yii::app()->user->id);
			$filtro_empresas=array();
			$getId = function($valor) {
				return $valor->id;
			};
			foreach($usuarioLog->empresas as $empUsu){
				$filtro_empresas=array_merge($filtro_empresas, array_map($getId, $empUsu->usuarios));
			}
			//$filtro_empresas;
		}


		if (isset($_GET['Descargas'])){
			$model->attributes = $_GET['Descargas'];			
		}

		if(isset($_GET['export']) && $_GET['export']=='grilla'){
				// marco como exportado
				$contenido= $this->renderPartial('excel',array('dataProvider'=>Yii::app()->user->getState('export'),),true);
				Yii::app()->request->sendFile('AW_Descargas.xls',$contenido);
    			Yii::app()->user->clearState('export');		
		}else if(isset($_GET['export']) && $_GET['export']=='csv'){
			// marco como exportado	
			$conf =  Configuracion::singleton();
			$configuracion = $conf->getAll();
			$delimitador = $configuracion['delimitador-csv'];					
			$contenido= $this->renderPartial('csv',array('dataProvider'=>Yii::app()->user->getState('export'),'delimitador'=>$delimitador),true);
			
			Yii::app()->request->sendFile('AW_Descargas.csv',Yii::app()->user->getState('exportCSV'),null,false);
			//Yii::app()->user->clearState('exportCSV',null);	
			//Analisis
			//Yii::log(" - PASO - ".var_export(Yii::app()->user->getState('export')->getData(),true), CLogger::LEVEL_WARNING, __METHOD__);
			$contenido= $this->renderPartial('csv_analisis',array('dataProvider'=>Yii::app()->user->getState('export'),'delimitador'=>$delimitador),true);
			Yii::app()->request->sendFile('AW_Analisis.csv',Yii::app()->user->getState('export_analisisCSV'));
			//Yii::app()->user->clearState('export_analisisCSV',null);	
			//Yii::app()->user->clearStates();	
		}else if(isset($_GET['export']) && $_GET['export']=='csv-a'){
			// marco como exportado	
			$conf =  Configuracion::singleton();
			$configuracion = $conf->getAll();
			$delimitador = $configuracion['delimitador-csv'];								
			//Analisis
			//Yii::log(" - PASO - ".var_export(Yii::app()->user->getState('export')->getData(),true), CLogger::LEVEL_WARNING, __METHOD__);
			$contenido= $this->renderPartial('csv_analisis',array('dataProvider'=>Yii::app()->user->getState('export'),'delimitador'=>$delimitador),true);
			Yii::app()->request->sendFile('AW_Analisis.csv',Yii::app()->user->getState('export_analisisCSV'));
			//Yii::app()->user->clearState('export_analisisCSV',null);	
			//Yii::app()->user->clearStates();	
		}

		

		$this->render('admin', array(
			'model' => $model,
			'filtro_empresas'=>$filtro_empresas,
		));
	}

	/* Importacion de archivos */
	public function actionImportar()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'		
		$model = new ImportarForm();
		$reg = 0;
		$archivos = CUploadedFile::getInstancesByName('archivo');
		if ((count($archivos) > 0) or (isset($_POST["ImportarForm"]["archivos_subidos"]) and $_POST["ImportarForm"]["archivos_subidos"] == 1)) {
			$model->attributes = $_POST["archivo"];
			if (count($archivos) > 0) {
				$model->archivo = $archivos[0];
			} else {
				$model->archivo = null;
			}
			if ($model->validate()) {
				// aqui entra CFileValidator
				//$filename = sys_get_temp_dir().'/'.$model->archivo->getName();
				if (isset($_POST["ImportarForm"]["archivos_subidos"]) and $_POST["ImportarForm"]["archivos_subidos"] == 1) {
					//recupero los archivos que esten en la carpeta temporal y los importo
					$archivos_generados = $this->showFiles();
				} else {
					$model->archivo->saveAs($model->archivo->getName());
					// trunco el archivo en mas chicos para agilizar la carga
					$archivos_generados = $this->truncarArchivo($model->archivo->getName());
					unlink($model->archivo->getName());/* borro el archivo original */
				}
				$errores = array();
				// recupero los porcentajes min de hum por producto
				$porc_min = MermasHumedad::getPorcentajesMin();
				$conf =  Configuracion::singleton();
				$configuracion = $conf->getAll();
				$delimitador = $configuracion['delimitador-importacion'];	
				$hoy =strtotime("now");			
				foreach ($archivos_generados as  $nom_arch) {
					$arch = fopen($nom_arch, 'r');
					if (!feof($arch)) {
						fgets($arch, 4096);
					}					
					while (!feof($arch)) {
						$linea = explode($delimitador, fgets($arch, 4096));						
						if (count($linea) >= 2) {							
							if ($_POST["formulario"] == 'descarga-form') {
								/**********************/
								/*   DESCARGAS    */
								/**********************/
								// compruebo que la carta de porte no exista en el sistema	
								$carta_de_porte = str_pad($linea[1], 9, $configuracion['coompletar_CP'], STR_PAD_LEFT); // se completa con 5 por izq hasta 9
								$descarga=Descargas::model()->find('carta_porte='.$carta_de_porte);
								if($descarga==null){
									$descarga                = new Descargas();
									//$descarga->fecha_carga	= date("Ymd"); // Fecha del día
									$descarga->carta_porte	= $carta_de_porte; 
									$fecha = $this->validateDate($linea[4],'Ymd');									
									$descarga->fecha_carta_porte	= $fecha? date("Ymd", strtotime($linea[4])):date("Ymd",$hoy);
									$descarga->cuit_titular	= $linea[8];
									$descarga->producto = intval($linea[14]);
									$descarga->cod_postal = $linea[20];
									$descarga->kg_brutos_procedencia = intval($linea[21]);
									$descarga->kg_tara_procedencia = intval($linea[22]);
									$descarga->kg_netos_procedencia = intval($linea[23]);
									$descarga->calidad = $linea[25]; // CALIDAD
									$descarga->porcentaje_humedad = floatval($linea[26]);
									$descarga->cuit_corredor = $linea[27];
									$descarga->cuit_destino = $linea[33];
									$descarga->cuit_destinatario = $linea[31];
									$descarga->chasis = $linea[39];
									$descarga->acoplado = $linea[40];
									$fecha = $this->validateDate($linea[45],'Ymd');
									$descarga->fecha_arribo	= $fecha? date("Ymd",strtotime($linea[45])):date("Ymd",$hoy);
									$fecha = $this->validateDate($linea[46],'Ymd');
									$descarga->fecha_descarga	= $fecha? date("Ymd",strtotime($linea[46])):date("Ymd",$hoy);
									$descarga->kg_brutos_destino = intval($linea[49]);
									$descarga->kg_tara_destino = intval($linea[50]);
									$descarga->kg_netos_destino = intval($linea[51]);
									$descarga->kg_merma_total = intval($linea[52]);
									$descarga->neto_aplicable = intval($linea[53]);
									$descarga->analisis = $linea[54];										
									$descarga->usuario =  Yii::app()->user->id;							
									
									$descarga->cuit_intermediario = $linea[10];
									$descarga->cuit_remitente_comercial = $linea[12];
									// calculo otras mermas
									$descarga->otras_mermas = intval($linea[52]);
									$descarga->merma_humedad = 0;
									if($descarga->porcentaje_humedad == 0 || $descarga->porcentaje_humedad < $porc_min[$descarga->producto]){
										$descarga->porcentaje_humedad=$porc_min[$descarga->producto];
									}else{
										$mer_hum = MermasHumedad::model()->findByPk(array('producto'=>$descarga->producto,'porcentaje_humedad'=>$descarga->porcentaje_humedad));
										if($mer_hum){
											$descarga->merma_humedad = round(($mer_hum->valor * $descarga->kg_netos_destino)/100);
											if($descarga->otras_mermas > $descarga->merma_humedad){
												$descarga->otras_mermas = $descarga->otras_mermas - $descarga->merma_humedad;
											}else{
												$descarga->otras_mermas = 0;
											}
										}else{
											Yii::log("Error importar descarga - No se encontro MermasHumedad Prod:".$descarga->producto." %: ".$descarga->porcentaje_humedad , CLogger::LEVEL_WARNING, __METHOD__);
										}
									}

									set_time_limit(2); // agrego 2 segundo al tiempo limite de ejecucion de query
									//Yii::log(" A DESCARG: " . var_export($descarga, true), CLogger::LEVEL_WARNING, __METHOD__);
									if (!$descarga->save()) {										
										// guardo los errores para mostrarlos juntos
										$errores[$carta_de_porte] = $descarga->getErrors();
										//Yii::app()->user->setFlash('danger', "Error ".var_export($descarga->getErrors(), true));
										//Yii::log("Error importar descarga: " . var_export($descarga->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
									}else{
										$reg++;	
										//$de = Descargas::model()->findByPk($descarga->id);
										//Yii::log("POS INSERT: " . var_export($de, true), CLogger::LEVEL_WARNING, __METHOD__);
									}
								}
							}
						}
					}  /* end while */
					fclose($arch);
					unlink($nom_arch);/* borro el archivo temporal q ya fue importado */
				}/* end foreach*/
				// compruebo si el arreglo de errores tiene datos
				if(count($errores)>0){
					$msj ='';
					//print_r($errores); exit();
					foreach ($errores as $cp => $err) {
						foreach ($err as $attr => $msj_err) {
							$msj.='CP: '.$cp.' Campo: '.$attr.'-'.$msj_err[0].' </br>';
						}
						
					}
					Yii::app()->user->setFlash('danger', "Error/es </br>".$msj);
				}
				Yii::app()->user->setFlash('success', "Se importaron " . $reg . " registros nuevos.");
				// save in runtime folder
				if (!empty($importoOk)) {
					Yii::log("### Ctas importadas: " . var_export($importoOk, true), CLogger::LEVEL_WARNING, __METHOD__);
				}
				if (!empty($actualizoOk)) {
					Yii::log("### Ctas actualizadas: " . var_export($actualizoOk, true), CLogger::LEVEL_WARNING, __METHOD__);
				}
			}
		}
		$this->render('importar', array('model' => $model));
	}

	public  static function truncarArchivo($to_read, $size = 70000, $directory_temp = 'archivosTemp/')
	{
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
				$chunk = fread($handle, $span); // read the chunk between START and END
				file_put_contents($directory_temp . $to_read . '_' . $part . '.txt', $header . $chunk);
				$files_result[] = $directory_temp . $to_read . '_' . $part . '.txt';
				$part++;
				if (strlen($chunk) < $size) $done = true;
			}
			fclose($handle);
		}
		return $files_result;
	}
	public  static function formatearFecha($fechaString)
	{
		// Esta funcion espera DD/MM/YY y retorna YY/MM/DD
		$fecha = date_create_from_format('j/n/Y', $fechaString);
		$result = date_format($fecha, 'y/m/d');
		return $result;
	}
	public  static function showFiles($path = 'archivosTemp/')
	{
		$dir = opendir($path);
		$files = array();
		while ($current = readdir($dir)) {
			if ($current != "." && $current != "..") {
				if (is_dir($path . $current)) {
					showFiles($path . $current . '/');
				} else {
					$files[] = $path . $current;
				}
			}
		}
		return $files;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Descargas::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'descargas-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAnalisis() {
		header("Content-type: application/json"); // para que devuelva mime json, jquery lo agradece.
		$descarga  = Descargas::model()->findByPk($_POST['descarga']);
		$analisis =$descarga->analisis0;		
		//echo CJSON::encode($analisis->bonifica_rebaja.' '.$analisis->valor);
		$html = CHtml::openTag('td', $htmlOptions = array('colspan'=>'8')).CHtml::openTag('table', $htmlOptions = array('class'=>'table table-bordered'))."<thead><tr> <th>Bonifica / Rebaja</th><th>Valor</th></tr></thead><tbody>
  <tr><td>".($analisis->bonifica_rebaja?'Bonifica':'Rebaja')."</td> <td>".$analisis->valor."</td></tr></tbody>".CHtml::closeTag('table'). CHtml::closeTag('td');
		echo CJSON::encode($html);
	}

	public  function validateDate($date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}
