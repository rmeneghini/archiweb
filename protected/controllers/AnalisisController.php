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
	public  static function normalizeSimpleXML($obj, &$result)
	{
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
				$texto = file_get_contents($model->archivo->getName());
				$xml = new SimpleXMLElement($texto);

				//$xml = new SimpleXMLElement(file_get_contents($model->archivo->getName()));
				if ($xml === FALSE) {
					Yii::log("Error importar análisis - No se pudo abrir", CLogger::LEVEL_WARNING, __METHOD__);
				} else {
					$errores = array();
					/*AnalisisController::normalizeSimpleXML($xml, $result);*/					
					$campo_conf='conf_import'.$_POST['config'];				
					foreach ($xml->children() as $solicitud) {
						$contador = 0;
						$cartaP = (string) $solicitud->CamionVagon->Item['NumeroDeCartaDePorte'];						
						$codProducto=(string) $solicitud->Matriz['Codigo'];
						// Recupero el producto por el cod dependiendo la conf seleccionada
						$prod = Producto::model()->find($campo_conf.'='.$codProducto);
						$prodDesc=(string)  $solicitud->Matriz['Descripcion'];
						if(!$prod){
							// no se encontro el producto
							Yii::log("Error importar análisis - No se encontro el producto ".$prodDesc, CLogger::LEVEL_WARNING, __METHOD__);
							exit();
						}
						//<Matriz Codigo="2" Descripcion="MAÍZ" />
						// si no tiene EnsayoTecnica se toma, sino se ignora
						foreach ($solicitud->EnsayoTecnica as $ensayoTec) {	
							if($contador == 0 ){
								print_r('<br/>');
								print_r('Prod: '.$codProducto.' - '.$prodDesc);	
								print_r('<br/>');
								print_r('CP:'.$cartaP);
								print_r('<br/>');
								}					
							$contador++;							
							$codRubro = (string) $ensayoTec->Ensayo['Codigo'];
							// Recupero el rubro por el cod dependiendo la conf seleccionada
							$rubro = Rubro::model()->find($campo_conf.'='.$codRubro);
							$valorRubro = (string) $ensayoTec->ResultadosYComponentes->ResultadoComponente->ResultadoDelEnsayo['Alfabetico'];
							// Recupero calculo valor
							$calc_valor = RubroCalculoValor::model()->find('producto='.$prod->id.' AND rubro='.$rubro.' AND valor_desde>='.$valorRubro.' AND '.$valorRubro.'<=valor_hasta');
							if(!$calc_valor){
								// VER que hacer si no se encontro el rubro_calculo_valor
								Yii::log("Error importar análisis - No se encontro el rubro_calc_valor ".$prod->id.' - '.$rubro.' - '.$valorRubro, CLogger::LEVEL_WARNING, __METHOD__);
							}else{
								$diferencia = ($calc_valor->diferencia_valor_hasta == 1)? $calc_valor->valor_hasta - $valorRubro : 0; // consultar
								$calculo =  $diferencia * $calc_valor->castiga_bonifica;
								$adiciona = $calculo + $calc_valor->adicionar_a_castiga_bonifica;
								$adiciona = $calc_valor->bonifica==1 ?   $adiciona : $adiciona  * -1;
								// grabo el analisis
								$analisis = new Analisis;
								$analisis->rubro = $rubro;
								$analisis->carta_porte = $cartaP;
								$analisis->producto = $prod->id;
								$analisis->bonifica_rebaja = $adiciona;
								$analisis->valor = $valorRubro;
								$analisis->usuario = Yii::app()->user->id;
								if(!$analisis->save()){
									$errores[$cartaP] =$analisis->getErrors();
									Yii::log("Error importar análisis - No pudo insertar ".$analisis->getErrors(), CLogger::LEVEL_WARNING, __METHOD__);
								}else{
									$reg++;
								}
							}
							
							//print_r('CP:'.$cartaP.' Cod:'.$codRubro.' Valor:'.$valorRubro);
							//print_r('<br/>');
						}
						if($contador >0 ){	
							// reviso el caso especial 
							// busco si hay un rubro "Peso Hectolitrico" para esta carta de porte de ser así recalculo el rubro Contenido proteico
							
						}
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
					}					
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
