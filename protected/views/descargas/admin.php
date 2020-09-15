<?php
$this->breadcrumbs = array(
	'Descargas' => array('index'),
	'Administrar',
);
$this->parametros = array(
	'titulo' => 'Administrar Descargas',
);
//Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)
$this->menu = array(
	array('label' => 'Listar Descargas', 'url' => array('index')),
	array('label' => 'Crear Descargas', 'url' => array('create')),
	array('label' => 'Importar Descargas', 'url' => array('importar'), 'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)),
);
Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('descargas-grid', {
		data: $(this).serialize()
	});
return false;
});
");
?>
<h1>Administrar Descargas</h1>
<?php
$this->widget(
    'booster.widgets.TbButtonGroup',
    array(
        'context' => 'primary',
		//'toggle' => 'radio',  
		//'justified' => true,      
        'buttons' => array(
            array('label' => 'Listar Todas', 'icon'=>'list-alt', 'url' =>array('index'), 'buttonType' =>'link',),
            array('label' => 'Carga Manual', 'icon'=>'plus-sign', 'url' =>array('create'), 'buttonType' =>'link',),
            array('label' => 'Importar', 'icon'=>'import', 'url' =>array('importar'), 'buttonType' =>'link',),
			array('label' => 'Exportar Excel', 'icon'=>'export',  'buttonType' =>'link','url'=>array('admin','export'=>'grilla')),
			array('label' => 'Exportar CSV', 'icon'=>'export',  'buttonType' =>'link','url'=>array('admin','export'=>'csv')),
        ),
    )
);
?>
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'descargas-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'fecha_carga',
		'carta_porte',
		'fecha_carta_porte',
		'cuit_titular',
		array('name'=>'analisis0','value' =>'$data->analisis0 ? "SI": "NO"'),
		array('name'=>'producto','value'=>'$data->producto0->getProducto()','filter'=>Producto::getProductos('id')),
		/*
		'cod_postal',
		'kg_brutos_procedencia',
		'kg_tara_procedencia',
		'kg_netos_procedencia',
		'calidad',
		'porcentaje_humedad',
		'merma_humedad',
		'cuit_corredor',
		'cuit_destino',
		'chasis',
		'acoplado',
		'fecha_arribo',
		'fecha_descarga',
		'kg_brutos_destino',
		'kg_tara_destino',
		'kg_netos_destino',
		'kg_merma_total',
		'otras_mermas',
		'neto_aplicable',
		'analisis',
		'porcentaje_zaranda',
		'merma_zaranda',
		'fumigado',
		'usuario',
		'analisis_finalizado',
		*/
		array(
			'class' => 'booster.widgets.TbButtonColumn',
		),
	),
)); ?>