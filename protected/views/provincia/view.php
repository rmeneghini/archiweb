<?php
$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Provincia', 'url'=>array('index')),
	array('label'=>'Crear Provincia', 'url'=>array('create')),
	array('label'=>'Actualizar Provincia', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Provincia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Provincia', 'url'=>array('admin')),
);
?>

<h1>Ver Provincia: &nbsp;<?php echo $model->nombre; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nombre',
		array('name'=>'pais', 'value'=>CHtml::encode($model->pais0->nombre)),
),
)); ?>
