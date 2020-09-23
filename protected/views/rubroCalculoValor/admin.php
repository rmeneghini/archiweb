<?php
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	'Administrar',
);
$this->parametros=array(
	'titulo'=>'Administrar Rubros Productos Cálculo',
);
$this->menu=array(
	array('label'=>'Listar Rubro', 'url'=>array('index')),
	array('label'=>'Crear Rubro', 'url'=>array('create','producto'=>$model->producto,'rubro'=>$model->rubro)),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('rubro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Administrar Rubros Productos Cálculo</h1>

<?php $botones = array(
    'class'=>'booster.widgets.TbButtonColumn',
    'template'=>'{view} {update} {delete}',
    'buttons'=>array
    (
        'view' => array(            
            'url'=>'Yii::app()->createUrl("rubrocalculovalor/view", array("producto"=>$data->producto,"rubro"=>$data->rubro,"valor_desde"=>$data->valor_desde,"valor_hasta"=>$data->valor_hasta))',
		),
		'update' => array(            
            'url'=>'Yii::app()->createUrl("rubrocalculovalor/update", array("producto"=>$data->producto,"rubro"=>$data->rubro,"valor_desde"=>$data->valor_desde,"valor_hasta"=>$data->valor_hasta))',
		),
		'delete' => array(            
            'url'=>'Yii::app()->createUrl("rubrocalculovalor/delete", array("producto"=>$data->producto,"rubro"=>$data->rubro,"valor_desde"=>$data->valor_desde,"valor_hasta"=>$data->valor_hasta))',
        ),                
    ),
);?>

<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'rubro-calculo-valor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
			array('name'=>'producto','value'=>'$data->productos->getProducto()','filter'=>Producto::getProductos('id')),
			array('name'=>'rubro','value'=>'$data->rubros->descripcion','filter'=>Rubro::getRubros('id')),
			'valor_desde',
			'valor_hasta',
			array('name'=>'diferencia_valor_hasta', 'value'=>'$data->diferencia_valor_hasta ? "SI" : "NO"'),			
			array('name'=>'bonifica', 'value'=>'$data->bonifica ? "SI" : "NO"'),						
			'castiga_bonifica',
			'adicionar_a_castiga_bonifica',
	$botones,
),
)); ?>
