
<?php
$this->breadcrumbs=array(
	'Analisises',
);
$this->parametros=array(
	'titulo'=>'Analisises',
);


$this->menu=array(
	array('label'=>'Crear Analisis', 'url'=>array('create')),
	array('label'=>'Administrar Analisis', 'url'=>array('admin')),
);
?>

<h1>Analisises</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
