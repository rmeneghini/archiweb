<?php

$this->breadcrumbs=array(

	'Personas'=>array('index'),

	$model->id,

);

$this->parametros=array(

	'titulo'=>'Ver Persona',

);



$this->menu=array(

	array('label'=>'Listar Persona', 'url'=>array('index')),

	array('label'=>'Crear Persona', 'url'=>array('create')),

	array('label'=>'Actualizar Persona', 'url'=>array('update', 'id'=>$model->id)),

	array('label'=>'Eliminar Persona', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>'Administrar Persona', 'url'=>array('admin')),

);

?>



<h1>Ver Persona #<?php echo $model->id; ?></h1>



<?php $this->widget('booster.widgets.TbDetailView',array(

'data'=>$model,

'attributes'=>array(

		'id',

		'dni',

		'nombre',

		'apellido',

		array('name'=>'direccion','value'=>CHtml::encode(  $model->direccion.' - '.$model->localidad.' - '.$model->provincia)),

		'email',

		array('name'=>'telefono_1','label'=>'Teléfonos','value'=>CHtml::encode( $model->telefono_1.' / '.$model->telefono_2)),

		array('name'=>'fecha_nac','value'=>CHtml::encode( date("d-m-Y", strtotime($model->fecha_nac)))),		

		//'id_usuario',

		//'id_localidad',

),

)); ?>

