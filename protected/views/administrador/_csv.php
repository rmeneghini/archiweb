<?php 
if($primero){
	$row = array();
	$row[]= CHtml::encode($data->getAttributeLabel('nro_cedulon'));
	$row[]= CHtml::encode($data->getAttributeLabel('cod_barras'));
	$row[]= CHtml::encode($data->getAttributeLabel('fecha_vto'));
	$row[]= CHtml::encode($data->getAttributeLabel('id_persona'));	
	$row[]= CHtml::encode($data->getAttributeLabel('id_persona'));
	$row[]= CHtml::encode($data->getAttributeLabel('tasa'));
	$row[]= CHtml::encode($data->getAttributeLabel('imp_total'));
	$row[]= CHtml::encode($data->getAttributeLabel('fecha_hora_generacion'));
	$row[]= CHtml::encode('Cuota');
	$row[]= CHtml::encode('Importe Cuota');
	$row[]= CHtml::encode('Nro Cuenta');
	$row[]= CHtml::encode('Año');
	fputcsv($fp,$row,$delimitador);	
}
foreach ($data->cuotas as $cuota){
	$row = array();
	$row[]= CHtml::encode($data->nro_cedulon);
	$row[]= CHtml::encode($data->cod_barras);
	$row[]= CHtml::encode($data->fecha_vto);	
	$row[]= CHtml::encode($data->id_persona);	
	$row[]= CHtml::encode($data->persona0->nombre);
	$row[]= CHtml::encode($data->tasa);
	$row[]= CHtml::encode('$'.$data->imp_total);
	$row[]= CHtml::encode($data->fecha_hora_generacion);
	$row[]= CHtml::encode($cuota->numero);
	$row[]= CHtml::encode('$'.$cuota->importe);
	$row[]= CHtml::encode($cuota->idCuenta->nro);
	$row[]= CHtml::encode($cuota->anio);
	fputcsv($fp,$row,$delimitador,chr(0));
}
?>
