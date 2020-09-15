
<?php
$this->breadcrumbs=array(
	'Tipo Entidads'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver TipoEntidad',
);


$this->menu=array(
	array('label'=>'Listar TipoEntidad', 'url'=>array('index')),
	array('label'=>'Crear TipoEntidad', 'url'=>array('create')),
	array('label'=>'Actualizar TipoEntidad', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar TipoEntidad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar TipoEntidad', 'url'=>array('admin')),
);
?>

<h1>Ver TipoEntidad #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'descripcion',

),
)); ?>
