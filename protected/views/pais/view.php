<?php
$this->breadcrumbs=array(
	'Paises'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Pais',
);

$this->menu=array(
	array('label'=>'Listar Pais', 'url'=>array('index')),
	array('label'=>'Crear Pais', 'url'=>array('create')),
	array('label'=>'Actualizar Pais', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Pais', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Pais', 'url'=>array('admin')),
);
?>

<h1>Ver Pais #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombre',
		'codigo',
),
)); ?>
