<?php
if($filas > 1)
	$columnas_empresa = array(
		array('id'=>'chk','class' => 'CCheckBoxColumn', 'value'=>'$data["id"]'),		
		'cuit',
		'razon_social',
	);
else
	$columnas_empresa = array(
		'cuit',
		'razon_social',
	);
?>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'empresa-grid',
        'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	 'selectionChanged'=>(isset($funcionSelectedRow)?$funcionSelectedRow:''),
	'selectableRows'=>$filas,
	'columns'=>$columnas_empresa,
)); ?>