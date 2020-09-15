<?php
$this->breadcrumbs=array(
	'Mermas Humedad'=>array('index'),
	'Administrar',
);
$this->parametros=array(
	'titulo'=>'Administrar Mermas Humedad',
);
$this->menu=array(
	array('label'=>'Listar Mermas Humedad', 'url'=>array('index')),
	array('label'=>'Crear Mermas Humedad', 'url'=>array('create','producto'=>$model->producto,'porcentaje_humedad'=>$model->porcentaje_humedad)),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('porcentaje_humedad-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Administrar Mermas Humedad</h1>

<?php $botones = array(
    'class'=>'booster.widgets.TbButtonColumn',
    'template'=>'{view} {update} {delete}',
    'buttons'=>array
    (
        'view' => array(            
            'url'=>'Yii::app()->createUrl("mermashumedad/view", array("producto"=>$data->producto,"porcentaje_humedad"=>$data->porcentaje_humedad))',
		),
		'update' => array(            
            'url'=>'Yii::app()->createUrl("mermashumedad/update", array("producto"=>$data->producto,"porcentaje_humedad"=>$data->porcentaje_humedad))',
		),
		'delete' => array(            
            'url'=>'Yii::app()->createUrl("mermashumedad/delete", array("producto"=>$data->producto,"porcentaje_humedad"=>$data->porcentaje_humedad))',
        ),                
    ),
);?>

<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'porcentaje_humedad-calculo-valor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
			array('name'=>'producto','value'=>'$data->productos->getProducto()','filter'=>Producto::getProductos('id')),
			'porcentaje_humedad',
			'valor',
	$botones,
),
)); ?>
