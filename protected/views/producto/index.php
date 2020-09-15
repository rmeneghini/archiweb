
<?php
$this->breadcrumbs=array(
	'Productos',
);
$this->parametros=array(
	'titulo'=>'Productos',
);


$this->menu=array(
	array('label'=>'Crear Producto', 'url'=>array('create')),
	array('label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<h1>Productos</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
