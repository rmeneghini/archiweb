
<?php
$this->breadcrumbs=array(
	'Empresas',
);
$this->parametros=array(
	'titulo'=>'Empresas',
);


$this->menu=array(
	array('label'=>'Crear Empresa', 'url'=>array('create')),
	array('label'=>'Administrar Empresa', 'url'=>array('admin')),
);
?>

<h1>Empresas</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
