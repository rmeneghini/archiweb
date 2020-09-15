
<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Producto',
);


$this->menu=array(
	array('label'=>'Listar Producto', 'url'=>array('index')),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Crear Producto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
