<?php
$this->breadcrumbs=array(
	'Entidades',
);
$this->parametros=array(
	'titulo'=>'Entidades',
);
$this->menu=array(
	array('label'=>'Crear Entidad', 'url'=>array('create')),
	array('label'=>'Administrar Entidades', 'url'=>array('admin')),
);
?>
<h1>Entidades</h1>
<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
