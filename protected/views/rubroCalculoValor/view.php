<?php
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	$model->productos->getProducto().' '.$model->rubros->descripcion,
);
$this->parametros=array(
	'titulo'=>'Ver Rubro Cálculo Valor',
);
$this->menu=array(
	array('label'=>'Listar Rubro Cálculo Valor', 'url'=>array('index')),
	array('label'=>'Crear Rubro Cálculo Valor', 'url'=>array('create')),
	array('label'=>'Actualizar Rubro Cálculo Valor', 'url'=>array('update', 'producto'=>$model->producto,'rubro'=>$model->rubro)),
	array('label'=>'Eliminar Rubro Cálculo Valor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','producto'=>$model->producto,'rubro'=>$model->rubro),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Rubro Cálculo Valor', 'url'=>array('admin')),
);
?>
<h1>Ver Rubro Cálculo Valor <?php echo $model->productos->getProducto().' '.$model->rubros->descripcion; ?></h1>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
	array('name'=>'producto','value'=>$model->productos->getProducto()),
	array('name'=>'rubro','value'=>$model->rubros->descripcion),
	'valor_desde',
	'valor_hasta',
	array('name'=>'diferencia_valor_hasta', 'value'=>$model->diferencia_valor_hasta ? "SI" : "NO"),			
	array('name'=>'bonifica', 'value'=>$model->bonifica ? "SI" : "NO"),						
	'castiga_bonifica',
	'adicionar_a_castiga_bonifica',
),
)); ?>
