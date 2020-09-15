
<?php
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Rubro',
);


$this->menu=array(
	array('label'=>'Listar Rubro', 'url'=>array('index')),
	array('label'=>'Crear Rubro', 'url'=>array('create')),
	array('label'=>'Actualizar Rubro', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Rubro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Rubro', 'url'=>array('admin')),
);
?>

<h1>Ver Rubro #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'descripcion',

),
)); ?>
