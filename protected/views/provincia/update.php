<?php
$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Provincia', 'url'=>array('index')),
	array('label'=>'Crear Provincia', 'url'=>array('create')),
	array('label'=>'Ver Provincia', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Provincia', 'url'=>array('admin')),
);
?>

<h1>Actualizar Provincia <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>