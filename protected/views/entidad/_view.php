
<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuit')); ?>:</b>
	<?php echo CHtml::encode($data->cuit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_entidad')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_entidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exportar')); ?>:</b>
	<?php echo CHtml::encode($data->exportar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('razonSocial')); ?>:</b>
	<?php echo CHtml::encode($data->razonSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />



</div>
