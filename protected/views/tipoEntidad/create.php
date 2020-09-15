
<?php
$this->breadcrumbs=array(
	'Tipo Entidads'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear TipoEntidad',
);


$this->menu=array(
	array('label'=>'Listar TipoEntidad', 'url'=>array('index')),
	array('label'=>'Administrar TipoEntidad', 'url'=>array('admin')),
);
?>

<h1>Crear TipoEntidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
