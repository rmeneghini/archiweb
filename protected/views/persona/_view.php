<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('dni')); ?>:</b>
	<?php echo CHtml::encode($data->dni); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellido')); ?>:</b>
	<?php echo CHtml::encode($data->apellido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion.' - '.$data->localidad.' - '.$data->provincia); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_1')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_1); ?>
	<br /><br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_2')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_nac')); ?>:</b>
	<?php echo CHtml::encode(date("d-m-Y", strtotime($data->fecha_nac))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_localidad')); ?>:</b>
	<?php echo CHtml::encode($data->id_localidad); ?>
	<br />

	*/ ?>

</div>
