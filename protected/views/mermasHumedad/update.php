<?php
$this->breadcrumbs=array(
	'Mermas Humedad'=>array('index'),
	$model->productos->getProducto().' '.$model->porcentaje_humedad=>array('view','producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad),
	'Actualizar',
);
$this->parametros=array(
	'titulo'=>'Modificar Mermas Humedad',
);
$this->menu=array(
	array('label'=>'Listar Mermas Humedad', 'url'=>array('index')),
	array('label'=>'Crear Mermas Humedad', 'url'=>array('create')),
	array('label'=>'Ver Mermas Humedad', 'url'=>array('view', 'producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad)),
	array('label'=>'Administrar Mermas Humedad', 'url'=>array('admin')),
);
?>
<h1>Actualizar Mermas Humedad <?php echo $model->productos->getProducto().' '.$model->porcentaje_humedad; ?></h1>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
