<?php

/**
 * This is the model class for table "descargas".
 *
 * The followings are the available columns in table 'descargas':
 * @property integer $id
 * @property string $fecha_carga
 * @property string $carta_porte
 * @property string $fecha_carta_porte
 * @property string $cuit_titular
 * @property integer $producto
 * @property string $cod_postal
 * @property integer $kg_brutos_procedencia
 * @property integer $kg_tara_procedencia
 * @property integer $kg_netos_procedencia
 * @property string $calidad
 * @property double $porcentaje_humedad
 * @property integer $merma_humedad
 * @property string $cuit_corredor
 * @property string $cuit_destino
 * @property string $chasis
 * @property string $acoplado
 * @property string $fecha_arribo
 * @property string $fecha_descarga
 * @property integer $kg_brutos_destino
 * @property integer $kg_tara_destino
 * @property integer $kg_netos_destino
 * @property integer $kg_merma_total
 * @property integer $otras_mermas
 * @property integer $neto_aplicable
 * @property string $analisis
 * @property double $porcentaje_zaranda
 * @property integer $merma_zaranda
 * @property integer $fumigado
 * @property integer $usuario
 * @property integer $analisis_finalizado
 * @property string $cuit_intermediario
 * @property string $cuit_remitente_comercial
 * @property string $cuit_destinatario
 * @property integer $exportado
 * @property string $cupo_alfanumerico
 * The followings are the available model relations:
 * @property Producto $producto0
 * @property Usuario $usuario0
 */
class Descargas extends CActiveRecord
{
	public $titular;//busqueda por razosocial titular
	public $corredor;//busqueda por razosocial corredor
	public $destino;//busqueda por razosocial destino

	public $fecha_rango; // filtro desde hasta fecha_carga

	function init()
	{
		
		if ($this->isNewRecord && empty($_POST['Descargas'])) {			
			//Yii::log(" - INIT - ", CLogger::LEVEL_WARNING, __METHOD__);
			// set defaults
			$this->fecha_carga	= date("Y-m-d");
			$this->fecha_carta_porte = date("Y-m-d");			
			$this->analisis_finalizado = 0;
			$this->porcentaje_zaranda = 0;
			$this->merma_humedad = 0;
			$this->otras_mermas = 0;
			$this->merma_zaranda = 0;
		}
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'descargas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_carga, fecha_carta_porte, carta_porte, cuit_titular, producto, calidad, porcentaje_humedad, merma_humedad, cuit_destino, kg_brutos_destino, kg_tara_destino, kg_netos_destino, otras_mermas, neto_aplicable, porcentaje_zaranda, merma_zaranda, usuario, chasis', 'required'),
			array('carta_porte, cuit_titular, producto, fumigado, usuario, analisis_finalizado, exportado', 'numerical', 'integerOnly' => true),
			array('kg_brutos_procedencia, kg_tara_procedencia, kg_netos_procedencia,kg_brutos_destino, kg_tara_destino, kg_netos_destino, kg_merma_total, otras_mermas, neto_aplicable, merma_zaranda, merma_humedad', 'numerical', 'integerOnly' => false),
			array('porcentaje_humedad, porcentaje_zaranda', 'numerical'),
			array('carta_porte', 'length', 'max' => 9,'min'=> 9),
			array('carta_porte','unique','message' => 'Carta de porta ya ingresada al sistema'),
			array('cuit_titular, cuit_corredor, cuit_destino, cuit_intermediario, cuit_remitente_comercial, cuit_destinatario', 'length', 'max' => 12),
			array('cuit_titular, cuit_destino, cuit_intermediario, cuit_remitente_comercial', 'validar_cuit'),
			array('cod_postal', 'length', 'max' => 6),
			array('calidad', 'length', 'max' => 3),
			array('chasis, acoplado', 'length', 'max' => 8),
			array('analisis', 'length', 'max' => 120),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fecha_rango,titular,corredor,destino,id,fecha_carga, carta_porte, fecha_carta_porte, cuit_titular, producto, cod_postal, kg_brutos_procedencia, kg_tara_procedencia, kg_netos_procedencia, calidad, porcentaje_humedad, merma_humedad, cuit_corredor, cuit_destino, chasis, acoplado, fecha_arribo, fecha_descarga, kg_brutos_destino, kg_tara_destino, kg_netos_destino, kg_merma_total, otras_mermas, neto_aplicable, analisis, porcentaje_zaranda, merma_zaranda, fumigado, usuario, analisis_finalizado, cuit_intermediario, cuit_remitente_comercial, cuit_destinatario, exportado', 'safe', 'on' => 'search'),
		);
	}

	// funcion eu valida los cuit que esten en la table entidad
	public function validar_cuit($attribute,$params) {		
		// si el cuit es cero o null lo dejo pasar solo para los intermediarios y comerciales
		if(!$this->$attribute && ($attribute=='cuit_intermediario' || $attribute=='cuit_remitente_comercial')
		|| ($this->$attribute=='0' && ($attribute=='cuit_intermediario' || $attribute=='cuit_remitente_comercial'))
		){
			return;
		}
		$entidad=Entidad::model()->find('cuit=?',array($this->$attribute));            
		if(!$entidad) {
			$this->addError($attribute, 'El cuit ingresado no esta registrado como una entidad.');                
		}
	}
	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
			'usuario0' => array(self::BELONGS_TO, 'Usuario', 'usuario','joinType'=>'INNER JOIN'),		
			'analisis0' => array(self::HAS_ONE, 'Analisis', array('carta_porte' => 'carta_porte')),
			'ent_titular' => array(self::BELONGS_TO, 'Entidad', array('cuit_titular' => 'cuit')),
			'ent_corredor' => array(self::BELONGS_TO, 'Entidad', array('cuit_corredor' => 'cuit')),
			'ent_destino' => array(self::BELONGS_TO, 'Entidad', array('cuit_destino' => 'cuit')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_carga' => 'Fecha Carga',
			'carta_porte' => 'Carta Porte',
			'fecha_carta_porte' => 'Fecha Carta Porte',
			'cuit_titular' => 'Cuit Titular',
			'producto' => 'Producto',
			'cod_postal' => 'Cod Postal',
			'kg_brutos_procedencia' => 'Kg Brutos Procedencia',
			'kg_tara_procedencia' => 'Kg Tara Procedencia',
			'kg_netos_procedencia' => 'Kg Netos Procedencia',
			'calidad' => 'Calidad',
			'porcentaje_humedad' => 'Porcentaje Humedad',
			'merma_humedad' => 'Merma Humedad',
			'cuit_corredor' => 'Cuit Corredor',
			'cuit_destino' => 'Cuit Destino',
			'chasis' => 'Chasis',
			'acoplado' => 'Acoplado',
			'fecha_arribo' => 'Fecha Arribo',
			'fecha_descarga' => 'Fecha Descarga',
			'kg_brutos_destino' => 'Kg Brutos Destino',
			'kg_tara_destino' => 'Kg Tara Destino',
			'kg_netos_destino' => 'Kg Netos Destino',
			'kg_merma_total' => 'Kg Merma Total',
			'otras_mermas' => 'Otras Mermas',
			'neto_aplicable' => 'Neto Aplicable',
			'analisis' => 'Observacion Analisis',
			'porcentaje_zaranda' => 'Porcentaje Zaranda',
			'merma_zaranda' => 'Merma Zaranda',
			'fumigado' => 'Fumigado',
			'usuario' => 'Usuario',
			'analisis_finalizado' => 'Analisis Finalizado',
			'cuit_intermediario' => 'Cuit Intermediario',
			'cuit_remitente_comercial' => 'Cuit Remitente Comercial',
			'cuit_destinatario' => 'Cuit Destinatario',	
			'exportado' => 'Exportado',
            'cupo_alfanumerico' => 'Cupo Alfanumerico',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($filtro_empresas = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria;
		$criteria->with = array('usuario0','ent_titular','ent_corredor','ent_destino');
		//Yii::log(" - PASO DESCARGA- ".var_export(explode(" - ", $this->usuario),true), CLogger::LEVEL_WARNING, __METHOD__);
		$criteria->compare('id', $this->id);
                if(isset($this->fecha_rango) && $this->fecha_rango != ''){
			//Yii::log(" - PASO - ".var_export(explode(" - ", $this->fecha_rango),true), CLogger::LEVEL_WARNING, __METHOD__);
			$rango =explode(" - ", $this->fecha_rango);
			$feDesde=explode("/",$rango[0]);
			$feHasta=explode("/",$rango[1]);
			//$criteria->addCondition('DATE_FORMAT(t.fecha_carga,"%d/%m/%Y") >= "'.$rango[0].'"');
			//$criteria->addCondition('DATE_FORMAT(t.fecha_carga,"%d/%m/%Y") <= "'.$rango[1].'"');
			$criteria->addCondition('t.fecha_carga >= "'.$feDesde[2].'-'.$feDesde[1].'-'.$feDesde[0].'"');
			$criteria->addCondition('t.fecha_carga <= "'.$feHasta[2].'-'.$feHasta[1].'-'.$feHasta[0].'"');
			
		}
		//$criteria->compare('DATE_FORMAT(fecha_carga,"%d/%m/%Y")',  $this->fecha_carga, true);
		//Yii::log(" - PASO - ".var_export($this,true), CLogger::LEVEL_WARNING, __METHOD__);
		$criteria->compare('carta_porte', $this->carta_porte, true);
		$criteria->compare('DATE_FORMAT(fecha_carta_porte,"%d/%m/%Y")', $this->fecha_carta_porte, true);
		$criteria->compare('cuit_titular', $this->cuit_titular, true);
		$criteria->compare('producto', $this->producto);
		$criteria->compare('cod_postal', $this->cod_postal, true);
		$criteria->compare('kg_brutos_procedencia', $this->kg_brutos_procedencia);
		$criteria->compare('kg_tara_procedencia', $this->kg_tara_procedencia);
		$criteria->compare('kg_netos_procedencia', $this->kg_netos_procedencia);
		$criteria->compare('calidad', $this->calidad, true);
		$criteria->compare('porcentaje_humedad', $this->porcentaje_humedad);
		$criteria->compare('merma_humedad', $this->merma_humedad);
		$criteria->compare('cuit_corredor', $this->cuit_corredor, true);
		$criteria->compare('cuit_destino', $this->cuit_destino, true);
		$criteria->compare('chasis', $this->chasis, true);
		$criteria->compare('acoplado', $this->acoplado, true);
		$criteria->compare('fecha_arribo', $this->fecha_arribo, true);
		$criteria->compare('fecha_descarga', $this->fecha_descarga, true);
		$criteria->compare('kg_brutos_destino', $this->kg_brutos_destino);
		$criteria->compare('kg_tara_destino', $this->kg_tara_destino);
		$criteria->compare('kg_netos_destino', $this->kg_netos_destino);
		$criteria->compare('kg_merma_total', $this->kg_merma_total);
		$criteria->compare('otras_mermas', $this->otras_mermas);
		$criteria->compare('neto_aplicable', $this->neto_aplicable);
		$criteria->compare('analisis', $this->analisis, true);
		$criteria->compare('porcentaje_zaranda', $this->porcentaje_zaranda);
		$criteria->compare('merma_zaranda', $this->merma_zaranda);
		$criteria->compare('fumigado', $this->fumigado);
		$criteria->compare('exportado',$this->exportado);
		$criteria->compare('cupo_alfanumerico',$this->cupo_alfanumerico);

		$criteria->order = 't.fecha_carga DESC';

		//busqueda por razon social titular
		$criteria->compare('ent_titular.razonSocial', $this->titular, true);
		//busqueda por razon social corredor
		$criteria->compare('ent_corredor.razonSocial', $this->corredor, true);
		//busqueda por razon social destino
		$criteria->compare('ent_destino.razonSocial', $this->destino, true);
		
		
		//$criteria->compare('ent_titular.razonSocial', $this->ent_titular->razonSocial, true);
		// si el filtro de empresas no es null, selecciono los usuarios
		if($filtro_empresas){
			$criteria->addInCondition('t.usuario',$filtro_empresas);
		}
		//$criteria->compare('t.usuario', $this->usuario);
		//filtro usuario
		if (Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id) || Yii::app()->authManager->checkAccess('super', Yii::app()->user->id)){
			$criteria->compare('usuario0.nombre', $this->usuario, true);
		}else{
			$criteria->compare('t.usuario', Yii::app()->user->id);
		}
		
		
		
		$criteria->compare('analisis_finalizado', $this->analisis_finalizado);
		$criteria->compare('cuit_intermediario', $this->cuit_intermediario, true);
		$criteria->compare('cuit_remitente_comercial', $this->cuit_remitente_comercial, true);
		$criteria->compare('cuit_destinatario', $this->cuit_destinatario, true);
		$criteria->group = 't.carta_porte';
		$criteria->limit=Yii::app()->params['limit'];
		

		// en los datos que guardo en la sesion excluyo las descargas cuyas entidades indica q no exportan
		$temp_criteria = clone $criteria;
		if(empty($temp_criteria->condition)){
			$temp_criteria->condition .= 't.cuit_destino IN (SELECT entidad.cuit FROM entidad WHERE entidad.exportar=1 and entidad.tipo_entidad=3)';// esta hard code el tipo hay q mejorar esto
		}else{
			$temp_criteria->condition .= ' AND t.cuit_destino IN (SELECT entidad.cuit FROM entidad WHERE entidad.exportar=1 and entidad.tipo_entidad=3)';// esta hard code el tipo hay q mejorar esto
		}
		//$temp_criteria->condition .= ' AND t.cuit_destino IN (SELECT entidad.cuit FROM entidad WHERE entidad.exportar=1 and entidad.tipo_entidad=3)';// esta hard code el tipo hay q mejorar esto
		//$temp_criteria->order='t.fecha_carga DESC';
		$temp_criteria->with = array('analisis0');
		$temp_criteria->together = true;	
		//$temp_criteria->limit=Yii::app()->params['limit'];
		Yii::app()->user->setState('export',null);
		Yii::app()->user->setState('export', new CActiveDataProvider(get_class($this), array('criteria' => $temp_criteria, 'pagination' => false,)));
				
		//Yii::log(" - PASO - ".var_export(Yii::app()->user->getState('pageSize'),true), CLogger::LEVEL_WARNING, __METHOD__);
		$dataProvider =new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			//'pagination'=>array('pageSize'=>20)
		));
		//Yii::log(" - PASO - ".var_export($dataProvider->getPagination(),true), CLogger::LEVEL_WARNING, __METHOD__);
		return $dataProvider;
	}

	// En este metodo relizo los calculos desp de crear una descarga, por ej el analisis
	
	public function insert($attributes = null){

		// si Calidad es CO, G1, G2, G3 analisis finalizado lleva true
		$this->analisis_finalizado = intval(Descargas::analisisFinalizado($this->calidad));

		if ($result = parent::insert($attributes)) {
			
			$calidades = array("G1", "G2", "G3");
			if (in_array($this->calidad, $calidades)) {
				// busco el id del rubro
				$rubro = Rubro::model()->find('valores LIKE "%' . $this->calidad . '%"');
				if ($rubro) {
					$analisis = new Analisis();
					$analisis->rubro = $rubro->id;
					$analisis->carta_porte = $this->carta_porte;
					$analisis->producto = $this->producto;
					$analisis->usuario = $this->usuario;
					$analisis->valor = floatval(preg_replace('/[^0-9]+/', '', $this->calidad));
					// busco el rubro calculo valor
					$rubroCalValor = RubroCalculoValor::model()->find('producto=' . $this->producto . ' AND rubro=' . $rubro->id . ' AND valor_desde >= ' . $analisis->valor . ' AND valor_hasta <= ' . $analisis->valor);
					if ($rubroCalValor) {
						$analisis->bonifica_rebaja = $rubroCalValor->bonifica==1 ?  $rubroCalValor->castiga_bonifica : $rubroCalValor->castiga_bonifica * -1;
					} else {
						// se debe setear un error y eliminar la descarga
						Yii::app()->user->setFlash('danger', "Falta Rubro Calculo Valor . Prod:".$this->producto.' Rubro:'. $rubro->id." Valor:".$analisis->valor);
						$this->delete();
						return false;
					}
					if (!$analisis->save()) {
						Yii::log("No grabo analisis: " . var_export($analisis->getErrors(), true), CLogger::LEVEL_WARNING, __METHOD__);
					}
				}
			}
		}
		return $result;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Descargas the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	// Devuelve verdadero o falso si la calidad indica que tiene finalizado el analisis
	public static function analisisFinalizado($calidad)
	{
		return in_array($calidad, array("CO", "G1", "G2", "G3"));
	}
}
