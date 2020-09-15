
<?php
$this->breadcrumbs=array(
	'Analisises'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Analisis',
);


$this->menu=array(
	array('label'=>'Listar Analisis', 'url'=>array('index')),
	array('label'=>'Crear Analisis', 'url'=>array('create')),
	array('label'=>'Ver Analisis', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Analisis', 'url'=>array('admin')),
);
?>

<h1>Actualizar Analisis <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
