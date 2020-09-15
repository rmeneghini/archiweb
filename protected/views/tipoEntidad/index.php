
<?php
$this->breadcrumbs=array(
	'Tipo Entidads',
);
$this->parametros=array(
	'titulo'=>'Tipo Entidads',
);


$this->menu=array(
	array('label'=>'Crear TipoEntidad', 'url'=>array('create')),
	array('label'=>'Administrar TipoEntidad', 'url'=>array('admin')),
);
?>

<h1>Tipo Entidads</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
