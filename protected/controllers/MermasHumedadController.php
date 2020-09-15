<?php
class MermasHumedadController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	public function actionView($producto,$porcentaje_humedad)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($producto,$porcentaje_humedad),
		));
	}
	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new MermasHumedad;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['MermasHumedad'])){
			$model->attributes=$_POST['MermasHumedad'];
			if($model->save())
			$this->redirect(array('view','producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad));
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
	public function actionUpdate($producto,$porcentaje_humedad)
	{
		$model=$this->loadModel($producto,$porcentaje_humedad);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['MermasHumedad'])){
			$model->attributes=$_POST['MermasHumedad'];
			if($model->save())
				$this->redirect(array('view','producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($producto,$porcentaje_humedad)
	{
		if(Yii::app()->request->isPostRequest){
			// we only allow deletion via POST request
			$this->loadModel($producto,$porcentaje_humedad)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	* Lists all models.
	*/
	public function actionIndex($producto=null,$porcentaje_humedad=null)
	{
		$criteria=new CDbCriteria; 
		if($producto) {
			$criteria->compare('producto',$producto,true);  
		}else if($porcentaje_humedad){
			$criteria->compare('porcentaje_humedad',$porcentaje_humedad,true);  
		}    
		
		
		$dataProvider=new CActiveDataProvider('MermasHumedad',array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	* Manages all models.
	*/
	public function actionAdmin($producto=null,$porcentaje_humedad=null)
	{
		
		$model=new MermasHumedad('search');
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MermasHumedad']))
			$model->attributes=$_GET['MermasHumedad'];			
		if($producto) {
			$model->producto = $producto;  
		}else if($porcentaje_humedad){
			$model->porcentaje_humedad = $porcentaje_humedad;  
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
	public function loadModel($producto,$porcentaje_humedad)
	{
		$model=MermasHumedad::model()->findByPk(array('producto'=>$producto,'porcentaje_humedad'=>$porcentaje_humedad));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='mermas-humedad-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
