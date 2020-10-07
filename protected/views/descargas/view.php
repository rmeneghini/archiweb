<?php
$this->breadcrumbs=array(
	'Descargases'=>array('index'),
	$model->id,
);
$this->parametros=array(
	'titulo'=>'Ver Descargas',
);
$this->menu=array(
	//array('label'=>'Listar Descargas', 'url'=>array('index')),
	array('label'=>'Crear Descargas', 'url'=>array('create')),
	array('label'=>'Actualizar Descargas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Descargas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Descargas', 'url'=>array('admin')),
);
?>
<h1>Ver Descargas #<?php echo $model->id; ?></h1>
<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		array('name'=>'fecha_carga','value'=>date("d/m/Y",strtotime($model->fecha_carga))),
		'carta_porte',
		array('name'=>'fecha_carta_porte','value'=>date("d/m/Y",strtotime($model->fecha_carta_porte))),
		'cuit_titular',
		'producto',
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
		array('name'=>'fecha_arribo','value'=>date("d/m/Y",strtotime($model->fecha_arribo))),
		array('name'=>'fecha_descarga','value'=>date("d/m/Y",strtotime($model->fecha_descarga))),
		'kg_brutos_destino',
		'kg_tara_destino',
		'kg_netos_destino',
		'kg_merma_total',
		'otras_mermas',
		'neto_aplicable',
		'analisis',
		'porcentaje_zaranda',
		'merma_zaranda',
		array('name'=>'fumigado','value' =>$model->fumigado ? "SI": "NO"),
		array('name'=>'usuario','value'=>$model->usuario0->nombre),
		array('name'=>'analisis_finalizado','value'=>$model->analisis_finalizado ? "SI": "NO"),
),
)); ?>
