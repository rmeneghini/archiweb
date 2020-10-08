<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Administrar',
);
$this->parametros=array(
	'titulo'=>'Administrar Productos',
);
$this->menu=array(
	array('label'=>'Listar Producto', 'url'=>array('index')),
	array('label'=>'Crear Producto', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('producto-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<h1>Administrar Productos</h1>
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

<?php $botones = array(
    'class'=>'booster.widgets.TbButtonColumn',
    'template'=>'{view}{update}{delete}{rubro-cal}',
    'buttons'=>array
    (        
        'rubro-cal' => array
        (
            'label'=>'<i class="glyphicon glyphicon-random"></i>',            
            'options'=>array('title'=>'Rubro Calculo'),
            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
            'url'=>'Yii::app()->createUrl("rubrocalculovalor/admin", array("producto"=>$data->id))',
        ),         
    ),
);?>
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'producto-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'descripcion',
		'lleva_grado',
$botones,
),
)); ?>
