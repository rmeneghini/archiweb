<?php
$this->breadcrumbs=array(
	'Personas'=>array('index'),
	'Administrar',
);
$this->parametros=array(
	'titulo'=>'Administrar Personas',
);

$this->menu=array(
	array('label'=>'Listar Persona', 'url'=>array('index')),
	array('label'=>'Crear Persona', 'url'=>array('create')),
	array('label'=>'Importar Persona', 'url'=>array('importar')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('persona-grid', {
	data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Personas / Contribuyentes</h1>

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

<?php $botones = array(
    'class'=>'booster.widgets.TbButtonColumn',
    'template'=>'{view}{update}{delete}{usuario}',
    'buttons'=>array
    (
        'usuario' => array
        (
            'label'=>'<i class="glyphicon glyphicon-user xs"></i>',            
            'options'=>array('title'=>'Crear Usuario'),
            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
            'url'=>'Yii::app()->createUrl("usuario/asociar", array("persona"=>$data->id,"usuario_id"=>$data->id_usuario))',
        ),        
    ),
);
 $columnas= array('id','nombre','apellido','direccion',$botones,);
?>
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'persona-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>$columnas
)); ?>
