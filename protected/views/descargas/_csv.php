<?php 
if($primero){
	$row = array();
	$row[]= CHtml::encode($data->getAttributeLabel('fecha_carga'));
	$row[]= CHtml::encode($data->getAttributeLabel('carta_porte'));
	$row[]= CHtml::encode($data->getAttributeLabel('cuit_titular'));
	$row[]= CHtml::encode($data->getAttributeLabel('cuit_intermediario'));
	$row[]= CHtml::encode($data->getAttributeLabel('cuit_remitente_comercial'));
	$row[]= CHtml::encode($data->getAttributeLabel('producto'));
	$row[]= CHtml::encode($data->getAttributeLabel('cuit_destinatario'));
	$row[]= CHtml::encode($data->getAttributeLabel('cuit_destino'));
	$row[]= CHtml::encode($data->getAttributeLabel('chasis'));
	$row[]= CHtml::encode($data->getAttributeLabel('cuit_corredor'));
	$row[]= CHtml::encode($data->getAttributeLabel('kg_brutos_destino'));
	$row[]= CHtml::encode($data->getAttributeLabel('kg_tara_destino'));
	$row[]= CHtml::encode($data->getAttributeLabel('kg_netos_destino'));
	$row[]= CHtml::encode($data->getAttributeLabel('porcentaje_humedad'));
	$row[]= CHtml::encode($data->getAttributeLabel('merma_humedad'));
	$row[]= CHtml::encode($data->getAttributeLabel('porcentaje_zaranda'));
	$row[]= CHtml::encode($data->getAttributeLabel('merma_zaranda'));
	$row[]= CHtml::encode($data->getAttributeLabel('otras_mermas'));
	$row[]= CHtml::encode($data->getAttributeLabel('analisis_finalizado'));
	$row[]= CHtml::encode($data->getAttributeLabel('fumigado'));
	$row[]= CHtml::encode($data->getAttributeLabel('analisis'));//observaciones
	$row[]= CHtml::encode($data->getAttributeLabel('fecha_descarga'));
	$row[]= CHtml::encode($data->getAttributeLabel('cupo_alfanumerico'));
	$row[]= CHtml::encode($data->getAttributeLabel('ctg'));

	fputcsv($fp,$row,$delimitador);	
}

	$row = array();
	$row[]= CHtml::encode($data->fecha_carga);
	$row[]= CHtml::encode($data->carta_porte);
	$row[]= CHtml::encode($data->cuit_titular);	
	$row[]= CHtml::encode($data->cuit_intermediario);	
	$row[]= CHtml::encode($data->cuit_remitente_comercial);
	$row[]= CHtml::encode($data->producto);
	$row[]= CHtml::encode($data->cuit_destinatario);
	$row[]= CHtml::encode($data->cuit_destino);
	$row[]= CHtml::encode($data->chasis);
	$row[]= CHtml::encode($data->cuit_corredor);
	$row[]= CHtml::encode($data->kg_brutos_destino);
	$row[]= CHtml::encode($data->kg_tara_destino);
	$row[]= CHtml::encode($data->kg_netos_destino);
	$row[]= CHtml::encode($data->porcentaje_humedad);
	$row[]= CHtml::encode($data->merma_humedad);
	$row[]= CHtml::encode($data->porcentaje_zaranda);
	$row[]= CHtml::encode($data->merma_zaranda);
	$row[]= CHtml::encode($data->otras_mermas);
	$row[]= CHtml::encode($data->analisis_finalizado ? 'SI' : 'NO');
	$row[]= CHtml::encode($data->fumigado ? 'SI' : 'NO');
	$row[]= CHtml::encode($data->analisis);
	$row[]= CHtml::encode($data->fecha_descarga);
	$row[]= CHtml::encode($data->cupo_alfanumerico);
	$row[]= CHtml::encode($data->ctg==0 ? " " : $data->ctg);
	
	fputcsv($fp,$row,$delimitador,chr(0));
//}
?>
