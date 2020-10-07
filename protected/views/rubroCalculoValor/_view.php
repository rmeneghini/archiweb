<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('producto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productos->getProducto()),array('view','producto'=>$data->producto,'rubro'=>$data->rubro,'valor_desde'=>$data->valor_desde,'valor_hasta'=>$data->valor_hasta)); ?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('rubro')); ?>:</b>
	<?php echo CHtml::encode($data->rubros->descripcion); ?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_desde')); ?>:</b>
	<?php echo CHtml::encode($data->valor_desde); ?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_hasta')); ?>:</b>
	<?php echo CHtml::encode($data->valor_hasta); ?>	
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('diferencia_valor_hasta')); ?>:</b>
	<?php echo CHtml::encode($data->diferencia_valor_hasta ? "SI" : "NO"); ?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('bonifica')); ?>:</b>
	<?php echo CHtml::encode($data->bonifica ? "SI" : "NO"); ?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('castiga_bonifica')); ?>:</b>
	<?php echo CHtml::encode($data->castiga_bonifica); ?>
	&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('adicionar_a_castiga_bonifica')); ?>:</b>
	<?php echo CHtml::encode($data->adicionar_a_castiga_bonifica); ?>
</div>



