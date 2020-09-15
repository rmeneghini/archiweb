<?php if($primero): ?>
<tr>
	<th> <?php echo CHtml::encode($data->getAttributeLabel('fecha_carga')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('carta_porte')); ?> </th>
	<th> <?php echo CHtml::encode($data->getAttributeLabel('cuit_titular')); ?> </th>
	<th> <?php echo CHtml::encode($data->getAttributeLabel('cuit_corredor')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('cuit_destino')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('producto')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('cuit_destino')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('cuit_corredor')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('kg_brutos_destino')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('kg_tara_destino')); ?> </th>
	<th> <?php echo CHtml::encode($data->getAttributeLabel('kg_netos_destino')); ?> </th>
	<th> <?php echo CHtml::encode($data->getAttributeLabel('porcentaje_humedad')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('merma_humedad')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('porcentaje_zaranda')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('merma_zaranda')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('otras_mermas')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('analisis_finalizado')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('fumigado')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('analisis')); ?> </th>	
	<th> <?php echo CHtml::encode($data->getAttributeLabel('fecha_descarga')); ?> </th>	
	
	
</tr>
<?php endif; ?>
<tr>	
	<td> <?php echo CHtml::encode($data->fecha_carga); ?> </td>	
	<td> <?php echo CHtml::encode($data->carta_porte); ?></td>	
	<td> <?php echo CHtml::encode($data->cuit_titular); ?></td>	
	<td> <?php echo CHtml::encode($data->cuit_corredor); ?></td>	
	<td> <?php echo CHtml::encode($data->cuit_destino); ?></td>
	<td> <?php echo CHtml::encode($data->producto); ?></td>	
	<td> <?php echo CHtml::encode($data->cuit_destino); ?> </td>	
	<td> <?php echo CHtml::encode($data->cuit_corredor); ?></td>	
	<td> <?php echo CHtml::encode($data->kg_brutos_destino); ?></td>	
	<td> <?php echo CHtml::encode($data->kg_tara_destino); ?></td>	
	<td> <?php echo CHtml::encode($data->kg_netos_destino); ?></td>
	<td> <?php echo CHtml::encode($data->porcentaje_humedad); ?></td>	
	<td> <?php echo CHtml::encode($data->merma_humedad); ?> </td>	
	<td> <?php echo CHtml::encode($data->porcentaje_zaranda); ?></td>	
	<td> <?php echo CHtml::encode($data->merma_zaranda); ?></td>	
	<td> <?php echo CHtml::encode($data->otras_mermas); ?></td>	
	<td> <?php echo CHtml::encode($data->analisis_finalizado); ?></td>
	<td> <?php echo CHtml::encode($data->fumigado); ?></td>	
	<td> <?php echo CHtml::encode($data->analisis); ?></td>
	<td> <?php echo CHtml::encode($data->fecha_descarga); ?></td>	
			
</tr>
