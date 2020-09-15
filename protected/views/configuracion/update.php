<?php
$this->breadcrumbs=array(
	'Configuracions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Configuracion',
);

$this->menu=array(
	array('label'=>'Listar Configuracion', 'url'=>array('index')),
	array('label'=>'Crear Configuracion', 'url'=>array('create')),
	array('label'=>'Ver Configuracion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Configuracion', 'url'=>array('admin')),
);
?>

<h1>Actualizar Configuracion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>