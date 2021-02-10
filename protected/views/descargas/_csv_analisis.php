<?php 
if($primero){
	$row = array();	
	$row[]= CHtml::encode('Carta Porte');
	$row[]= CHtml::encode('Rubro');
	$row[]= CHtml::encode('Descripción');
	$row[]= CHtml::encode('Valor');
	$row[]= CHtml::encode('Bonifica Rebaja');
	fputcsv($fpa,$row,$delimitador);	
}
if($data->analisis0){
	$row = array();
	$row[]= CHtml::encode($data->analisis0->carta_porte);
	$row[]= CHtml::encode($data->analisis0->rubro);
	$row[]= CHtml::encode($data->analisis0->rubro0->descripcion);	
	$row[]= CHtml::encode($data->analisis0->valor);	
	$row[]= CHtml::encode($data->analisis0->bonifica_rebaja);
	
	fputcsv($fpa,$row,$delimitador,chr(0));
}
?>
