<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Usuario',
);

$this->menu=array(
	array('label'=>'Listar Usuario', 'url'=>array('index')),
	array('label'=>'Crear Usuario', 'url'=>array('create')),
	array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
);
?>

<h1>Actualizar Usuario <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'rol'=>$rol,'empresas_asociadas'=>$empresas_asociadas,'empresas'=>$empresas)); ?>