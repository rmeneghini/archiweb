<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Persona',
);

$this->menu=array(
	array('label'=>'Listar Persona', 'url'=>array('index')),
	array('label'=>'Crear Persona', 'url'=>array('create')),
	array('label'=>'Ver Persona', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Persona', 'url'=>array('admin')),
);
?>

<h1>Actualizar Persona <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>