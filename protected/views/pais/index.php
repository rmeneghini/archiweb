<?php
$this->breadcrumbs=array(
	'Paises',
);
$this->parametros=array(
	'titulo'=>'Paises',
);

$this->menu=array(
	array('label'=>'Crear Pais', 'url'=>array('create')),
	array('label'=>'Administrar Pais', 'url'=>array('admin')),
);
?>

<h1>Paises</h1>

<?php $this->widget('booster.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
