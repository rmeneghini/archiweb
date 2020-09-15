
<?php
$this->breadcrumbs=array(
	'Tipo Entidads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar TipoEntidad',
);


$this->menu=array(
	array('label'=>'Listar TipoEntidad', 'url'=>array('index')),
	array('label'=>'Crear TipoEntidad', 'url'=>array('create')),
	array('label'=>'Ver TipoEntidad', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar TipoEntidad', 'url'=>array('admin')),
);
?>

<h1>Actualizar TipoEntidad <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
