<?php
$this->breadcrumbs=array(
	'Mermas Humedad'=>array('index'),
	$model->productos->getProducto().' '.$model->porcentaje_humedad,
);
$this->parametros=array(
	'titulo'=>'Ver Mermas Humedad',
);
$this->menu=array(
	array('label'=>'Listar Mermas Humedad', 'url'=>array('index')),
	array('label'=>'Crear Mermas Humedad', 'url'=>array('create')),
	array('label'=>'Actualizar Mermas Humedad', 'url'=>array('update', 'producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad)),
	array('label'=>'Eliminar Mermas Humedad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Mermas Humedad', 'url'=>array('admin')),
);
?>
<h1>Ver Mermas Humedad <?php echo $model->productos->getProducto().' '.$model->porcentaje_humedad; ?></h1>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
	array('name'=>'producto','value'=>$model->productos->getProducto()),
	'porcentaje_humedad',
	'valor',	
),
)); ?>
