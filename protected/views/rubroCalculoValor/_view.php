
<div class="view">



		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','producto'=>$data->producto,'rubro'=>$data->rubro,'valor_desde'=>$data->valor_desde,'valor_hasta'=>$data->valor_hasta)); ?>
	<br />

	




</div>

