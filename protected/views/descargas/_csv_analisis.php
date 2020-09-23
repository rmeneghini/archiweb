<?php 
if($primero){
	$row = array();	
	$row[]= CHtml::encode($data->analisis0->getAttributeLabel('carta_porte'));
	$row[]= CHtml::encode($data->analisis0->getAttributeLabel('rubro'));
	$row[]= CHtml::encode('Descripción');
	$row[]= CHtml::encode($data->analisis0->getAttributeLabel('valor'));
	$row[]= CHtml::encode($data->analisis0->getAttributeLabel('bonifica_rebaja'));
	fputcsv($fpa,$row,$delimitador);	
}
if($data->analisis0){
//foreach ($data->cuotas as $cuota){
	$row = array();
	$row[]= CHtml::encode($data->analisis0->carta_porte);
	$row[]= CHtml::encode($data->analisis0->rubro);
	$row[]= CHtml::encode($data->analisis0->rubro0->descripcion);	
	$row[]= CHtml::encode($data->analisis0->valor);	
	$row[]= CHtml::encode($data->analisis0->bonifica_rebaja);
	
	fputcsv($fpa,$row,$delimitador,chr(0));
}
//}
?>
