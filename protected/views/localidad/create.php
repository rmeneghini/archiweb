<?php
$this->breadcrumbs=array(
	'Localidads'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Localidad', 'url'=>array('index')),
	array('label'=>'Administrar Localidad', 'url'=>array('admin')),
);
?>

<h1>Crear Localidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>