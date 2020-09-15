<?php

/**
 * This is the model class for table "descargas".
 *
 * The followings are the available columns in table 'descargas':
 * @property integer $id
 * @property string $fecha_carga
 * @property integer $carta_porte
 * @property string $fecha_carta_porte
 * @property integer $cuit_titular
 * @property integer $producto
 * @property string $cod_postal
 * @property integer $kg_brutos_procedencia
 * @property integer $kg_tara_procedencia
 * @property integer $kg_netos_procedencia
 * @property string $calidad
 * @property double $porcentaje_humedad
 * @property double $merma_humedad
 * @property integer $cuit_corredor
 * @property integer $cuit_destino
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
 *
 * The followings are the available model relations:
 * @property Producto $producto0
 * @property Usuario $usuario0
 */
class Descargas extends CActiveRecord
{

	function init(){
		if($this->isNewRecord) {
		// set defaults
		$this->fecha_carga	= date("Ymd");
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
			array('fecha_carga, carta_porte, cuit_titular, producto, calidad, porcentaje_humedad, merma_humedad, cuit_corredor, cuit_destino, fecha_arribo, fecha_descarga, kg_brutos_destino, kg_tara_destino, kg_netos_destino, kg_merma_total, otras_mermas, neto_aplicable, porcentaje_zaranda, merma_zaranda, usuario, analisis_finalizado', 'required'),
			array('carta_porte, cuit_titular, producto, cuit_corredor, cuit_destino, fumigado, usuario, analisis_finalizado', 'numerical', 'integerOnly'=>true),
			array('kg_brutos_procedencia, kg_tara_procedencia, kg_netos_procedencia,kg_brutos_destino, kg_tara_destino, kg_netos_destino, kg_merma_total, otras_mermas, neto_aplicable, merma_zaranda', 'numerical', 'integerOnly'=>false),
			array('porcentaje_humedad, merma_humedad, porcentaje_zaranda', 'numerical'),
			array('cod_postal', 'length', 'max'=>6),
			array('calidad', 'length', 'max'=>3),
			array('chasis, acoplado', 'length', 'max'=>7),
			array('analisis', 'length', 'max'=>110),
			array('fecha_carta_porte', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_carga, carta_porte, fecha_carta_porte, cuit_titular, producto, cod_postal, kg_brutos_procedencia, kg_tara_procedencia, kg_netos_procedencia, calidad, porcentaje_humedad, merma_humedad, cuit_corredor, cuit_destino, chasis, acoplado, fecha_arribo, fecha_descarga, kg_brutos_destino, kg_tara_destino, kg_netos_destino, kg_merma_total, otras_mermas, neto_aplicable, analisis, porcentaje_zaranda, merma_zaranda, fumigado, usuario, analisis_finalizado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'producto0' => array(self::BELONGS_TO, 'Producto', 'producto'),
			'usuario0' => array(self::BELONGS_TO, 'Usuario', 'usuario'),
			'analisis0' => array(self::HAS_ONE, 'Analisis', array('carta_porte'=>'carta_porte')),
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
			'analisis' => 'Analisis',
			'porcentaje_zaranda' => 'Porcentaje Zaranda',
			'merma_zaranda' => 'Merma Zaranda',
			'fumigado' => 'Fumigado',
			'usuario' => 'Usuario',
			'analisis_finalizado' => 'Analisis Finalizado',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);
		$criteria->compare('carta_porte',$this->carta_porte);
		$criteria->compare('fecha_carta_porte',$this->fecha_carta_porte,true);
		$criteria->compare('cuit_titular',$this->cuit_titular);
		$criteria->compare('producto',$this->producto);
		$criteria->compare('cod_postal',$this->cod_postal,true);
		$criteria->compare('kg_brutos_procedencia',$this->kg_brutos_procedencia);
		$criteria->compare('kg_tara_procedencia',$this->kg_tara_procedencia);
		$criteria->compare('kg_netos_procedencia',$this->kg_netos_procedencia);
		$criteria->compare('calidad',$this->calidad,true);
		$criteria->compare('porcentaje_humedad',$this->porcentaje_humedad);
		$criteria->compare('merma_humedad',$this->merma_humedad);
		$criteria->compare('cuit_corredor',$this->cuit_corredor);
		$criteria->compare('cuit_destino',$this->cuit_destino);
		$criteria->compare('chasis',$this->chasis,true);
		$criteria->compare('acoplado',$this->acoplado,true);
		$criteria->compare('fecha_arribo',$this->fecha_arribo,true);
		$criteria->compare('fecha_descarga',$this->fecha_descarga,true);
		$criteria->compare('kg_brutos_destino',$this->kg_brutos_destino);
		$criteria->compare('kg_tara_destino',$this->kg_tara_destino);
		$criteria->compare('kg_netos_destino',$this->kg_netos_destino);
		$criteria->compare('kg_merma_total',$this->kg_merma_total);
		$criteria->compare('otras_mermas',$this->otras_mermas);
		$criteria->compare('neto_aplicable',$this->neto_aplicable);
		$criteria->compare('analisis',$this->analisis,true);
		$criteria->compare('porcentaje_zaranda',$this->porcentaje_zaranda);
		$criteria->compare('merma_zaranda',$this->merma_zaranda);
		$criteria->compare('fumigado',$this->fumigado);
		$criteria->compare('usuario',$this->usuario);
		$criteria->compare('analisis_finalizado',$this->analisis_finalizado);

		Yii::app()->user->setState('export',new CActiveDataProvider($this, array('criteria'=>$criteria,'pagination'=>false,)));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	// En este metodo relizo los calculos desp de crear una descarga, por ej el analisis
	protected function afterSave(){
		$calidades = array( "G1", "G2", "G3");
		if(in_array($this->calidad, $calidades)){
			// busco el id del rubro
			$rubro = Rubro::model()->find('valores LIKE "%'.$this->calidad.'%"');
			if($rubro){
				$analisis = new Analisis();
				$analisis->rubro = $rubro->id;
				$analisis->carta_porte = $this->carta_porte;
				$analisis->producto = $this->producto;
				$analisis->valor = floatval(preg_replace('/[^0-9]+/', '', $this->calidad));
				// busco el rubro calculo valor
				$rubroCalValor = RubroCalculoValor::model()->find('producto='.$this->producto.' AND rubro='.$rubro->id.' AND valor_desde >= '.$analisis->valor.' AND valor_hasta <= '.$analisis->valor);
				if($rubroCalValor){
					$analisis->bonifica_rebaja = $rubroCalValor->bonifica ?  $rubroCalValor->castiga_bonifica : $rubroCalValor->castiga_bonifica * -1;
				}					
				$analisis->save();
			}
			
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Descargas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// Devuelve verdadero o falso si la calidad indica que tiene finalizado el analisis
	public static function analisisFinalizado($calidad){		
		return in_array($calidad, array("CO", "G1", "G2", "G3"));
	}

	
}
