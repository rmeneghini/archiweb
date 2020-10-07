<?php
$this->breadcrumbs=array(
	'Rubros Productos Cálculo',
);
$this->parametros=array(
	'titulo'=>'Rubros Productos Cálculo',
);
$this->menu=array(
	//array('label'=>'Crear Rubro', 'url'=>array('create','producto'=>$model->producto,'rubro'=>$model->rubro)),
	array('label'=>'Administrar Rubros Productos Cálculo', 'url'=>array('admin')),
);
?>
<h1>Rubros Productos Cálculo</h1>
<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
