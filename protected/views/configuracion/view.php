<?php
$this->breadcrumbs=array(
	'Configuracions'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Configuracion',
);

$this->menu=array(
	array('label'=>'Listar Configuracion', 'url'=>array('index')),
	array('label'=>'Crear Configuracion', 'url'=>array('create')),
	array('label'=>'Actualizar Configuracion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Configuracion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Configuracion', 'url'=>array('admin')),
);
?>

<h1>Ver Configuracion #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'clave',
		'valor',
),
)); ?>
