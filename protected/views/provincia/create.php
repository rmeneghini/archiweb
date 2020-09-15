<?php
$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Provincia', 'url'=>array('index')),
	array('label'=>'Administrar Provincia', 'url'=>array('admin')),
);
?>

<h1>Crear Provincia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>