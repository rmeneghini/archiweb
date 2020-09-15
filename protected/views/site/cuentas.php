<?php
$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Importar',
);
$this->parametros=array(
	'titulo'=>'Importar Cuentas',
);

$this->menu=array(
	array('label'=>'Listar Cuentas', 'url'=>array('index')),
	array('label'=>'Administrar Cuentas', 'url'=>array('admin')),
);
?>

<h1>Importar Cuentas</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'cuenta-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well','enctype'=>'multipart/form-data'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<p class="help-block">El orden de los campos del csv debe ser el siguiente. TASA; NRO CUENTA; IDENTIFICADOR; DETALLE; CONTRIBUYENTE y se asumen que la primera fila son los títulos. El sistema controla por NRO CUENTA. Archivo sugerido: "i_arc_mae.csv"</p>


	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->fileFieldGroup($model,'archivo',array('widgetOptions'=>array('htmlOptions'=>array('name'=>'archivo[]')))); ?>

<div class="form-actions">
	<?php 
	echo CHtml::hiddenField('formulario', 'cuenta-form');
	$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>'Importar',
		)); ?>
</div>

<?php $this->endWidget(); ?>