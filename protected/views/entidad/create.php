
<?php
$this->breadcrumbs=array(
	'Entidads'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Entidad',
);


$this->menu=array(
	array('label'=>'Listar Entidad', 'url'=>array('index')),
	array('label'=>'Administrar Entidad', 'url'=>array('admin')),
);
?>

<h1>Crear Entidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
