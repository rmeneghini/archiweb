
<?php
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Empresa',
);


$this->menu=array(
	array('label'=>'Listar Empresa', 'url'=>array('index')),
	array('label'=>'Crear Empresa', 'url'=>array('create')),
	array('label'=>'Actualizar Empresa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Empresa', 'url'=>array('admin')),
);
?>

<h1>Ver Empresa #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'cuit',
		'razon_social',

),
)); ?>
