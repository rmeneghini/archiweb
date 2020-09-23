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
			array('label' => 'Exportar Descargas CSV', 'icon'=>'export',  'buttonType' =>'link','url'=>array('admin','export'=>'csv')),
			array('label' => 'Exportar Análisis CSV', 'icon'=>'export',  'buttonType' =>'link','url'=>array('admin','export'=>'csv-a')),
        ),
    )
);
?>

<?php $botones = array(
    'class'=>'booster.widgets.TbButtonColumn',
	'template'=>'{view}{update}{delete}{analisis}',
	'evaluateID' => true,
    'buttons'=>array
    (        
        'analisis' => array
        (		
			'visible'=>	'$data->analisis0',
			'label'=>'<i class="glyphicon glyphicon-plus-sign"></i>', 
			'id'=>'$data->id', 
			'url' => '"#".$data->id',          
            'options'=>array(
				'id' => '$data->id',
				'title'=>'Análisis',
				'onclick' => 'javascript:toggleRow($(this).attr("id"))',
			),
            //'url'=>'Yii::app()->createUrl("rubrocalculovalor/admin", array("producto"=>$data->id))',
        ),         
    ),
);?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'descargas-grid',
	'dataProvider' => $model->search($filtro_empresas),
	'filter' => $model,	
	'columns' => array(
		//'id',		
		//array('name'=>'analisis0','htmlOptions'=>array('class'=>'plus','id'=>'$data->id'),'value'=>'...'	,),
		array('name'=>'fecha_carga','value'=>'date("d/m/Y",strtotime($data->fecha_carga))'),
		'carta_porte',
		array('name'=>'fecha_carta_porte','value'=>'date("d/m/Y",strtotime($data->fecha_carta_porte))'),		
		'cuit_titular',
		array('name'=>'ent_titular.razonSocial','value'=>'$data->ent_titular->razonSocial','filter'=>CHtml::searchField('Descargas[titular]',$model->titular,array()) ),
		//array('name'=>'analisis0','value' =>'$data->analisis0 ? "SI": "NO"'),
		array('name'=>'producto','value'=>'$data->producto0->getProducto()','filter'=>Producto::getProductos('id')),
		//'cod_postal',
		/*'kg_brutos_procedencia',
		'kg_tara_procedencia',
		'kg_netos_procedencia',*/
		'calidad',
		'kg_netos_destino',
		'porcentaje_humedad',
		'merma_humedad',
		'porcentaje_zaranda',
		'otras_mermas',
		'analisis',
		'cuit_corredor',
		array('name'=>'ent_corredor.razonSocial','value'=>'$data->ent_corredor->razonSocial','filter'=>CHtml::searchField('Descargas[corredor]',$model->corredor,array()) ),
		'cuit_destino',
		array('name'=>'ent_destino.razonSocial','value'=>'$data->ent_destino->razonSocial','filter'=>CHtml::searchField('Descargas[destino]',$model->destino,array()) ),
		/*'chasis',
		'acoplado',
		'fecha_arribo',
		'fecha_descarga',
		'kg_brutos_destino',
		'kg_tara_destino',*/		
		/*'kg_merma_total',		
		'neto_aplicable',		
		'merma_zaranda',*/
		array('name'=>'fumigado','value' =>'$data->fumigado ? "SI": "NO"', 'filter' => array('0' => Yii::t('app', 'NO'), '1' => Yii::t('app', 'SI')),),		
		array('name'=>'analisis_finalizado','value' =>'$data->analisis_finalizado ? "SI": "NO"', 'filter' => array('0' => Yii::t('app', 'NO'), '1' => Yii::t('app', 'SI')),),		
		'usuario',
		
		$botones,
	),
)); ?>


<script>
function toggleRow(id) {	
    if ($('#table'+id).length) {
        $('#table'+id).remove();
    } else {
        $.ajax({
            'type': 'post',
			'cache': false,
            'data': {
                'descarga': id
            },
            'url': "<?php echo Yii::app()->createUrl('descargas/analisis'); ?>",
            'success': function (html) {
                var new_data = $('<tr></tr>').attr('class', 'info').html(html).attr('id', 'table'+id);
                new_data.insertAfter($('#' + id).parent().parent());
            },
            'error': function (err) {
                console.log(err);
            }
        });
    }
}

</script>
