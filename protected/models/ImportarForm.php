<?php

/**
 * Modelo del formulario importacion de archivos
 */
class ImportarForm extends CFormModel {

    public $archivo;
    public $archivos_subidos;

    public function rules()
    {
        return array(
        	array('archivo', 'length', 'max'=>100),	
            array('archivos_subidos','boolean'),		
        	);
    }

    public function attributeLabels(){
        return array(
            "archivo"=>"Archivo a Importar",
            "archivos_subidos"=>"Importar archivos ya subidos",
        );
    }
}
