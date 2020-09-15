<?php
$this->breadcrumbs=array(
	'Paises'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Pais',
);

$this->menu=array(
	array('label'=>'Listar Pais', 'url'=>array('index')),
	array('label'=>'Administrar Pais', 'url'=>array('admin')),
);
?>

<h1>Crear Pais</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>