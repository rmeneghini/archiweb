<?php
$this->breadcrumbs=array(
	'Paises'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Pais',
);

$this->menu=array(
	array('label'=>'Listar Pais', 'url'=>array('index')),
	array('label'=>'Crear Pais', 'url'=>array('create')),
	array('label'=>'Ver Pais', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Pais', 'url'=>array('admin')),
);
?>

<h1>Actualizar Pais <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>