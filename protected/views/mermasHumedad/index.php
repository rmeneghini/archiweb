
<?php
$this->breadcrumbs=array(
	'Rubros',
);
$this->parametros=array(
	'titulo'=>'Rubros',
);


$this->menu=array(
	array('label'=>'Crear Rubro', 'url'=>array('create')),
	array('label'=>'Administrar Rubro', 'url'=>array('admin')),
);
?>

<h1>Rubros</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
