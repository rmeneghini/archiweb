<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Localidad', 'url'=>array('index')),
	array('label'=>'Crear Localidad', 'url'=>array('create')),
	array('label'=>'Actualizar Localidad', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Localidad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Localidad', 'url'=>array('admin')),
);
?>

<h1>Ver Localidad: <?php echo $model->nombre; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombre',
		'codigo_postal',
		'provincia',
),
)); ?>
