<?php
$this->breadcrumbs=array(
	'Descargas',
);
$this->parametros=array(
	'titulo'=>'Descargas',
);
$this->menu=array(
	array('label'=>'Crear Descargas', 'url'=>array('create')),
	array('label'=>'Administrar Descargas', 'url'=>array('admin')),
);
?>
<h1>Descargas</h1>
<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
