<?php
$this->breadcrumbs=array(
	'Configuracions',
);
$this->parametros=array(
	'titulo'=>'Configuracions',
);

$this->menu=array(
	array('label'=>'Crear Configuracion', 'url'=>array('create')),
	array('label'=>'Administrar Configuracion', 'url'=>array('admin')),
);
?>

<h1>Configuracions</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
