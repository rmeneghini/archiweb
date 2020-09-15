
<?php
$this->breadcrumbs=array(
	'Analisises'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Analisis',
);


$this->menu=array(
	array('label'=>'Listar Analisis', 'url'=>array('index')),
	array('label'=>'Administrar Analisis', 'url'=>array('admin')),
);
?>

<h1>Crear Analisis</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
