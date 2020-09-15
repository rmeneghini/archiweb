<?php
$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Provincia', 'url'=>array('index')),
	array('label'=>'Crear Provincia', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('provincia-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administrar Provincias</h1>

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
'id'=>'provincia-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'nombre',
		array('name'=>'pais', 'value'=>'CHtml::encode($data->pais0->nombre)'),
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
