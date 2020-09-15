<?php
$this->breadcrumbs=array(
	'Localidades'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Localidad', 'url'=>array('index')),
	array('label'=>'Crear Localidad', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('localidad-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administrar Localidades</h1>

<p>
También puede escribir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ó <b>=</b>) al principio de cada uno de los valores de búsqueda para especificar cómo se debe hacer la comparación.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'localidad-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'nombre',
		'codigo_postal',
		'provincia',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
