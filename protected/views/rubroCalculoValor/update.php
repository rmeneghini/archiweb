<?php
$this->breadcrumbs=array(
	'Rubro Cálculo Valor'=>array('index'),
	$model->productos->getProducto().' '.$model->rubros->descripcion=>array('view','producto'=>$model->producto,'rubro'=>$model->rubro),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Rubro Cálculo Valor',
);
$this->menu=array(
	array('label'=>'Listar Rubro Cálculo Valor', 'url'=>array('index')),
	array('label'=>'Crear Rubro Cálculo Valor', 'url'=>array('create')),
	array('label'=>'Ver Rubro Cálculo Valor', 'url'=>array('view', 'producto'=>$model->producto,'rubro'=>$model->rubro)),
	array('label'=>'Administrar Rubro Cálculo Valor', 'url'=>array('admin')),
);
?>
<h1>Actualizar Rubro Cálculo Valor <?php echo $model->productos->getProducto().' '.$model->rubros->descripcion; ?></h1>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
