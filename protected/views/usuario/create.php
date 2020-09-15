<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Usuario',
);

$this->menu=array(
	array('label'=>'Listar Usuario', 'url'=>array('index')),
	array('label'=>'Administrar Usuario', 'url'=>array('admin')),
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'rol'=>$rol)); ?>