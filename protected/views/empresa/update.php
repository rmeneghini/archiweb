
<?php
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Empresa',
);


$this->menu=array(
	array('label'=>'Listar Empresa', 'url'=>array('index')),
	array('label'=>'Crear Empresa', 'url'=>array('create')),
	array('label'=>'Ver Empresa', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Empresa', 'url'=>array('admin')),
);
?>

<h1>Actualizar Empresa <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
