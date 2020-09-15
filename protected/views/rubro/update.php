
<?php
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Rubro',
);


$this->menu=array(
	array('label'=>'Listar Rubro', 'url'=>array('index')),
	array('label'=>'Crear Rubro', 'url'=>array('create')),
	array('label'=>'Ver Rubro', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Rubro', 'url'=>array('admin')),
);
?>

<h1>Actualizar Rubro <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
