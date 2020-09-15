<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'productos-grid',
    'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'selectableRows'=>$filas??1,
	//'selectionChanged'=>'function(id) { /*console.log($.fn.yiiGridView.getSelection(id));*/ }',
	'columns'=>array(
        array('id'=>'chk','class' => 'CCheckBoxColumn', 'value'=>'$data["id"]'),        
        'descripcion',
        ),		
)); ?>
