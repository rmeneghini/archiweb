
<?php
$this->breadcrumbs=array(
	'Entidads'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Entidad',
);


$this->menu=array(
	array('label'=>'Listar Entidad', 'url'=>array('index')),
	array('label'=>'Crear Entidad', 'url'=>array('create')),
	array('label'=>'Actualizar Entidad', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Entidad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Entidad', 'url'=>array('admin')),
);
?>

<h1>Ver Entidad #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'cuit',
		'tipo_entidad',
		'exportar',
		'razonSocial',
		'direccion',

),
)); ?>
