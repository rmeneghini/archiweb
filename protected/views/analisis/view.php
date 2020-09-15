
<?php
$this->breadcrumbs=array(
	'Analisises'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Analisis',
);


$this->menu=array(
	array('label'=>'Listar Analisis', 'url'=>array('index')),
	array('label'=>'Crear Analisis', 'url'=>array('create')),
	array('label'=>'Actualizar Analisis', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Analisis', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Analisis', 'url'=>array('admin')),
);
?>

<h1>Ver Analisis #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'rubro',
		'carta_porte',
		'producto',
		'bonifica_rebaja',
		'valor',

),
)); ?>
