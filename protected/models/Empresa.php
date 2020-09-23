<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $id
 * @property string $cuit
 * @property string $razon_social
 *
 * The followings are the available model relations:
 * @property Usuario[] $usuarios
 */
class Empresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuit, razon_social', 'required'),
			array('cuit', 'length', 'max'=>12),
			array('razon_social', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cuit, razon_social', 'safe', 'on'=>'search'),
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
			'usuarios' => array(self::MANY_MANY, 'Usuario', 'usuario_empresa(empresa, usuario)'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cuit' => 'Cuit',
			'razon_social' => 'Razon Social',
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
		$criteria->compare('cuit',$this->cuit,true);
		$criteria->compare('razon_social',$this->razon_social,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getEmpresas($clave) {
		return  CHtml::listData(Empresa::model()->findAll(),$clave,'razon_social');
	}

	// retorna las empresas que no tiene el usuario asociado
	public function getEmpresasNoAsociadas($usuario){		
    	//Yii::log("Paso " .$id_mesa, CLogger::LEVEL_WARNING, __METHOD__);
		$criteria=new CDbCriteria;		
		if($usuario){
        	$criteria->condition='t.id NOT IN (SELECT usuario_empresa.empresa FROM usuario_empresa WHERE usuario_empresa.usuario = '.$usuario.')';
		}
		$criteria->compare('cuit',$this->cuit,true);
		$criteria->compare('razon_social',$this->razon_social,true);      
        //Yii::log("Paso " .var_export($criteria, true), CLogger::LEVEL_WARNING, __METHOD__);
       
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
