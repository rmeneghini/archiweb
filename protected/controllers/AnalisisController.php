<?php
class AnalisisController extends Controller
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
				'actions' => array('index', 'view'),
				'users' => array('@'),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update', 'importar'),
				'roles' => array('admin'),
			),
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'roles' => array('admin'),
			),
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
		$model = new Analisis;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset($_POST['Analisis'])) {
			$model->attributes = $_POST['Analisis'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}
		$this->render('create', array(
			'model' => $model,
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
		if (isset($_POST['Analisis'])) {
			$model->attributes = $_POST['Analisis'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}
		$this->render('update', array(
			'model' => $model,
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
	public  static function normalizeSimpleXML($obj, &$result) {
		$data = $obj;
		if (is_object($data)) {
			$data = get_object_vars($data);
		}
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$res = null;
				AnalisisController::normalizeSimpleXML($value, $res);
				if (($key == '@attributes') && ($key)) {
					$result = $res;
				} else {
					$result[$key] = $res;
				}
			}
		} else {
			$result = $data;
		}
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
				/*if (isset($_POST["ImportarForm"]["archivos_subidos"]) and $_POST["ImportarForm"]["archivos_subidos"] == 1) {
					//recupero los archivos que esten en la carpeta temporal y los importo
					$archivos_generados = $this->showFiles();
				} else {
					$model->archivo->saveAs($model->archivo->getName());
					// trunco el archivo en mas chicos para agilizar la carga
					$archivos_generados = $this->truncarArchivo($model->archivo->getName());
					unlink($model->archivo->getName());// borro el archivo original 
				}*/	
				$model->archivo->saveAs($model->archivo->getName());			
				//$xmlStr = file_get_contents($model->archivo->getName());
				//$xml = simpleXML_load_file($model->archivo->getName());	
				$texto = file_get_contents( $model->archivo->getName() );
				$xml = new SimpleXMLElement( $texto );							
				
				//$xml = new SimpleXMLElement(file_get_contents($model->archivo->getName()));
				if($xml === FALSE){
					Yii::log("Error importar análisis - No se pudo abrir", CLogger::LEVEL_WARNING, __METHOD__);
				}else{
					/*AnalisisController::normalizeSimpleXML($xml, $result);*/
					print_r(count($xml->children()));print_r( '<br/>');
					foreach ( $xml->children() as $soliditud ) {
						print_r( $soliditud->getName() );
						print_r( '<br/>');
						$camionVagon = $soliditud->CamionVagon;
						$cartaP =$camionVagon->Item['NumeroDeCartaDePorte'];
						print_r((string) $cartaP);
						print_r( '<br/>');
					}
				}
				exit();
				$errores = array();
				// recupero los porcentajes min de hum por producto
				$porc_min = MermasHumedad::getPorcentajesMin();
				$conf =  Configuracion::singleton();
				$configuracion = $conf->getAll();
				$delimitador = $configuracion['delimitador-importacion'];
				$hoy = strtotime("now");
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
								$descarga = Descargas::model()->find('carta_porte=' . $carta_de_porte);
								if ($descarga == null) {
									$descarga                = new Descargas();
									//$descarga->fecha_carga	= date("Ymd"); // Fecha del día
									$descarga->carta_porte	= $carta_de_porte;
									$fecha = $this->validateDate($linea[4], 'Ymd');
									$descarga->fecha_carta_porte	= $fecha ? date("Ymd", strtotime($linea[4])) : date("Ymd", $hoy);
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
									$fecha = $this->validateDate($linea[45], 'Ymd');
									$descarga->fecha_arribo	= $fecha ? date("Ymd", strtotime($linea[45])) : date("Ymd", $hoy);
									$fecha = $this->validateDate($linea[46], 'Ymd');
									$descarga->fecha_descarga	= $fecha ? date("Ymd", strtotime($linea[46])) : date("Ymd", $hoy);
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
									if ($descarga->porcentaje_humedad == 0 || $descarga->porcentaje_humedad < $porc_min[$descarga->producto]) {
										$descarga->porcentaje_humedad = $porc_min[$descarga->producto];
									} else {
										$mer_hum = MermasHumedad::model()->findByPk(array('producto' => $descarga->producto, 'porcentaje_humedad' => $descarga->porcentaje_humedad));
										if ($mer_hum) {
											$descarga->merma_humedad = round(($mer_hum->valor * $descarga->kg_netos_destino) / 100);
											if ($descarga->otras_mermas > $descarga->merma_humedad) {
												$descarga->otras_mermas = $descarga->otras_mermas - $descarga->merma_humedad;
											} else {
												$descarga->otras_mermas = 0;
											}
										} else {
											Yii::log("Error importar descarga - No se encontro MermasHumedad Prod:" . $descarga->producto . " %: " . $descarga->porcentaje_humedad, CLogger::LEVEL_WARNING, __METHOD__);
										}
									}

									set_time_limit(2); // agrego 2 segundo al tiempo limite de ejecucion de query
									//Yii::log(" A DESCARG: " . var_export($descarga, true), CLogger::LEVEL_WARNING, __METHOD__);
									if (!$descarga->save()) {
										// guardo los errores para mostrarlos juntos
										$errores[$carta_de_porte] = $descarga->getErrors();
										//Yii::app()->user->setFlash('danger', "Error ".var_export($descarga->getErrors(), true));
										//Yii::log("Error importar descarga: " . var_export($descarga->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
									} else {
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
				if (count($errores) > 0) {
					$msj = '';
					//print_r($errores); exit();
					foreach ($errores as $cp => $err) {
						foreach ($err as $attr => $msj_err) {
							$msj .= 'CP: ' . $cp . ' Campo: ' . $attr . '-' . $msj_err[0] . ' </br>';
						}
					}
					Yii::app()->user->setFlash('danger', "Error/es </br>" . $msj);
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Analisis');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Analisis('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Analisis']))
			$model->attributes = $_GET['Analisis'];
		$this->render('admin', array(
			'model' => $model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Analisis::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'analisis-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
