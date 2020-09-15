<?php
$this->breadcrumbs=array(
	'Oficinas',
);
$this->parametros=array(
	'titulo'=>'Tasas',
);

$this->menu=array(	
	array('label'=>'Exportar Cedulones', 'url'=>array('exportar')),
);
?>

<h1>Cedulones Impresos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>