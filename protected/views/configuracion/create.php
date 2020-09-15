<?php
$this->breadcrumbs=array(
	'Configuracions'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Configuracion',
);

$this->menu=array(
	array('label'=>'Listar Configuracion', 'url'=>array('index')),
	array('label'=>'Administrar Configuracion', 'url'=>array('admin')),
);
?>

<h1>Crear Configuracion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>