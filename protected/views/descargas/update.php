<?php
$this->breadcrumbs=array(
	'Descargases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Descargas',
);
$this->menu=array(
	array('label'=>'Listar Descargas', 'url'=>array('index')),
	array('label'=>'Crear Descargas', 'url'=>array('create')),
	array('label'=>'Ver Descargas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Descargas', 'url'=>array('admin')),
);
?>
<h1>Actualizar Descargas <?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_form',array('model'=>$model,'modelProducto'=>$modelProducto,)); ?>
