<?php
$this->breadcrumbs=array(
	'Localidads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Localidad', 'url'=>array('index')),
	array('label'=>'Crear Localidad', 'url'=>array('create')),
	array('label'=>'Ver Localidad', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Localidad', 'url'=>array('admin')),
);
?>

<h1>Actualizar Localidad <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>