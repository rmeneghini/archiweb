
<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuit')); ?>:</b>
	<?php echo CHtml::encode($data->cuit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('razon_social')); ?>:</b>
	<?php echo CHtml::encode($data->razon_social); ?>
	<br />



</div>
