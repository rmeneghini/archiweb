<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Persona',
);
$this->menu=array(
	array('label'=>'Listar Persona', 'url'=>array('index')),
	array('label'=>'Administrar Persona', 'url'=>array('admin')),
);
?>
<h1>Crear Persona</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'pais'=>$pais)); ?>