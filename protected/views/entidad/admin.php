<?php
$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	'Administrar',
);
$this->parametros=array(
	'titulo'=>'Administrar Entidades',
);
$this->menu=array(
	array('label'=>'Listar Entidades', 'url'=>array('index')),
	array('label'=>'Crear Entidad', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('entidad-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<h1>Administrar Entidades</h1>
<!--p>
También puede escribir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ó <b>=</b>) al principio de cada uno de los valores de búsqueda para especificar cómo se debe hacer la comparación.
</p-->
<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'entidad-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'cuit',
		array('name'=>'tipo_entidad','value'=>'$data->tipoEntidad->descripcion','filter'=>TipoEntidad::getTipoEntidad('id')),
		array('name'=>'exportar','value' =>'$data->exportar ? "SI": "NO"'),		
		'razonSocial',
		'direccion',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
