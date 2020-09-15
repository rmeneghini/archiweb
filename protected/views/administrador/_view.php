<div class="view">

	
	<?php //echo CHtml::link('<span class="glyphicon glyphicon-print"></span>',array('imprimirCedulon','id'=>$data->id), array('target'=>'_blank', 'title'=>'Imprimir')); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_barras')); ?>:</b>
	<?php echo CHtml::encode($data->cod_barras); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_vto')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_vto); ?>
	&nbsp;-&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_hora_generacion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_hora_generacion); ?>
	<br />


</div>