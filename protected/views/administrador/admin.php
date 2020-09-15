<?php
$this->breadcrumbs=array(
	'Cedulons'=>array('index'),
	'Administrar',
);
$this->parametros=array(
	'titulo'=>'Administrar Cedulons',
);
$this->menu=array(	
	array('label'=>'Exportar Cedulones Grilla-Excel', 'url'=>array('admin','export'=>'grilla')),
    array('label'=>'Exportar Cedulones Grilla-CSV', 'url'=>array('admin','export'=>'csv')),
);
Yii::app()->clientScript->registerScript('appendFilter', '
$.appendFilter = function(name) {
    $("#cedulon-grid .filters").append("<input type=\'hidden\' name=\'"+name+"\' >");
}
$.appendFilter("Cedulon[filtro]");
', CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('updateGridView', '
$.updateGridView = function(gridID, name, value) {
    $("#"+gridID+" input[name=\'"+name+"\'], #"+gridID+" select[name=\'"+name+"\']").val(value);
    $.fn.yiiGridView.update(gridID, {data: $.param(
        $("#"+gridID+" .filters input, #"+gridID+" .filters select")
    )});
}
', CClientScript::POS_READY);
/*Yii::app()->clientScript->registerScript('search', "
$('[name=filtro]').click(function(){
	$.updateGridView();
   	return false;
});
");*/
?>
<h1>Administrar Cedulones Impresos</h1>
<?php
$this->widget(
    'booster.widgets.TbButtonGroup',
    array(
        'context' => 'primary',
        'toggle' => 'radio',        
        'buttons' => array(
            array('label' => 'Todos', 'icon'=>'refresh', 'htmlOptions'=>array('onclick'=>'$.updateGridView("cedulon-grid", "Cedulon[filtro]", "0"); ')),
            array('label' => 'Nuevo Cod Barras', 'icon'=>'barcode', 'htmlOptions'=>array('onclick'=>'$.updateGridView("cedulon-grid", "Cedulon[filtro]", "1"); ')),
            array('label' => 'Con Cod Barras', 'icon'=>'inbox', 'htmlOptions'=>array('onclick'=>'$.updateGridView("cedulon-grid", "Cedulon[filtro]", "2"); ')),
            array('label' => 'No Vencidos', 'icon'=>'calendar', 'htmlOptions'=>array('onclick'=>'$.updateGridView("cedulon-grid", "Cedulon[filtro]", "4"); ')),
            array('label' => 'No Exportados', 'icon'=>'export', 'htmlOptions'=>array('onclick'=>'$.updateGridView("cedulon-grid", "Cedulon[filtro]", "3"); ')),
        ),
    )
);
?>
 <?php /*echo CHtml::radioButtonList('filtro','',array('0'=>'todos','1'=>'Nuevo Cod Barras','2'=>'Con Cod Barras'), array( 'separator' => "  ", 'class'=>'filters' ));*/ ?>
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'cedulon-grid',
'afterAjaxUpdate'=>'function(slash, care) { $.appendFilter("Cedulon[filtro]"); }',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'cod_barras',
		array('name'=>'fecha_vto','value'=>'date("d-m-Y", strtotime($data->fecha_vto))'),
		array('name'=>'id_persona','value'=>'$data->persona0->nombre','header'=>'Contribuyente'),		
		array('name'=>'fecha_hora_generacion','value'=>'date("d-m-Y H:i:s", strtotime($data->fecha_hora_generacion))'),
		array('name'=>'filtro','visible'=>false),
		//array('class'=>'booster.widgets.TbButtonColumn',),
),
)); ?>
