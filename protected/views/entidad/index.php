
<?php
$this->breadcrumbs=array(
	'Entidads',
);
$this->parametros=array(
	'titulo'=>'Entidads',
);


$this->menu=array(
	array('label'=>'Crear Entidad', 'url'=>array('create')),
	array('label'=>'Administrar Entidad', 'url'=>array('admin')),
);
?>

<h1>Entidads</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
