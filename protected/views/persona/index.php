<?php
$this->breadcrumbs=array(
	'Personas',
);
$this->parametros=array(
	'titulo'=>'Personas',
);
$this->menu=array(
	array('label'=>'Crear Persona', 'url'=>array('create')),
	array('label'=>'Administrar Persona', 'url'=>array('admin')),
	array('label'=>'Importar Persona', 'url'=>array('importar')),
);
?>
<h1>Personas / Contribuyentes</h1>
<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
