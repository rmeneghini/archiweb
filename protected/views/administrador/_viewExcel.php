<?php if($primero): ?>

<tr>

	<th> <?php echo CHtml::encode($data->getAttributeLabel('nro_cedulon')); ?> </th>	

	<th> <?php echo CHtml::encode($data->getAttributeLabel('cod_barras')); ?> </th>

	<th> <?php echo CHtml::encode($data->getAttributeLabel('fecha_vto')); ?> </th>

	<th> <?php echo CHtml::encode($data->getAttributeLabel('id_persona')); ?> </th>	

	<th> <?php echo CHtml::encode($data->getAttributeLabel('id_persona')); ?> </th>	

	<th> <?php echo CHtml::encode($data->getAttributeLabel('tasa')); ?> </th>	

	<th> <?php echo CHtml::encode($data->getAttributeLabel('imp_total')); ?> </th>	

	<th> <?php echo CHtml::encode($data->getAttributeLabel('fecha_hora_generacion')); ?> </th>	

	<th> <?php echo CHtml::encode('Cuota'); ?> </th>

	<th> <?php echo CHtml::encode('Importe Cuota'); ?> </th>

	<th> <?php echo CHtml::encode('Nro Cuenta'); ?> </th>

	<th> <?php echo CHtml::encode('Año'); ?> </th>

	

</tr>

<?php endif; ?>

<tr>

	<?php foreach ($data->cuotas as $cuota): ?>

	<td> <?php echo CHtml::encode($data->nro_cedulon); ?> </td>	

	<td> <?php echo CHtml::encode($data->cod_barras); ?></td>	

	<td> <?php echo CHtml::encode($data->fecha_vto); ?></td>	

	<td> <?php echo CHtml::encode($data->id_persona); ?></td>	

	<td> <?php echo CHtml::encode($data->persona0->nombre); ?></td>

	<td> <?php echo CHtml::encode($data->tasa); ?></td>	

	<td> <?php echo CHtml::encode('$'.$data->imp_total); ?></td>

	<td> <?php echo CHtml::encode($data->fecha_hora_generacion); ?></td>

	<td> <?php echo CHtml::encode($cuota->numero); ?></td>

	<td> <?php echo CHtml::encode('$'.$cuota->importe); ?></td>

	<td> <?php echo CHtml::encode($cuota->idCuenta->nro); ?></td>

	<td> <?php echo CHtml::encode($cuota->anio); ?></td>

	<?php endforeach; ?>	

</tr>

