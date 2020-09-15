<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Producto',
);
$this->menu=array(
	array('label'=>'Listar Producto', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Actualizar Producto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Producto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>
<h1>Ver Producto #<?php echo $model->id; ?></h1>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'descripcion',
		array('name'=>'lleva_grado', 'value'=>$model->lleva_grado==1?"SI":"NO"),
),
)); ?>
