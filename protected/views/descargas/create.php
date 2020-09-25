<?php
$this->breadcrumbs=array(
	'Descargases'=>array('index'),
	'Crear',
);
$this->parametros=array(
	'titulo'=>'Crear Descargas',
);
$this->menu=array(
	array('label'=>'Listar Descargas', 'url'=>array('index')),
	array('label'=>'Administrar Descargas', 'url'=>array('admin')),
);
?>
<h1>Crear Descargas</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,
'modelEntidadTitular' => $modelEntidadTitular,
'modelEntidadCorredor' => $modelEntidadCorredor,
'modelEntidadDestino' => $modelEntidadDestino,
)); ?>
