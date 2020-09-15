
<?php
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Rubro',
);


$this->menu=array(
	array('label'=>'Listar Rubro', 'url'=>array('index')),
	array('label'=>'Administrar Rubro', 'url'=>array('admin')),
);
?>

<h1>Crear Rubro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
