<?php

$this->breadcrumbs=array(

	'Localidades',

);



$this->menu=array(

	array('label'=>'Crear Localidad', 'url'=>array('create')),

	array('label'=>'Administrar Localidad', 'url'=>array('admin')),

);

?>



<h1>Localidades</h1>



<?php $this->widget('booster.widgets.TbListView',array(

'dataProvider'=>$dataProvider,

'itemView'=>'_view',

)); ?>



