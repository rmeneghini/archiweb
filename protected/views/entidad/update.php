<?php
$this->breadcrumbs=array(
	'Entidads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Entidad',
);
$this->menu=array(
	array('label'=>'Listar Entidades', 'url'=>array('index')),
	array('label'=>'Crear Entidad', 'url'=>array('create')),
	array('label'=>'Ver Entidad', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Entidades', 'url'=>array('admin')),
);
?>
<h1>Actualizar Entidad <?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
