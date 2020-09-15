<?php
$this->breadcrumbs=array(
	'Provincias',
);

$this->menu=array(
	array('label'=>'Crear Provincia', 'url'=>array('create')),
	array('label'=>'Administrar Provincia', 'url'=>array('admin')),
);
?>

<h1>Provincias</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
