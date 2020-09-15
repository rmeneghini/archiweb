<?php
$this->breadcrumbs=array(
	'Cuotas'=>array('index'),
	'Importar',
);
$this->parametros=array(
	'titulo'=>'Importar Deuda',
);

$this->menu=array(
	array('label'=>'Listar Deuda', 'url'=>array('index')),
	array('label'=>'Administrar Deuda', 'url'=>array('admin')),
);
?>

<h1>Importar Deuda</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'cuotas-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well','enctype'=>'multipart/form-data'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<p class="help-block">El orden de los campos del csv debe ser el siguiente. TASA; CUENTA; AÑO; CUOTA; ESTADO; VENCIMIENTO; IMPORTE; NRO CEDULON y se asumen que la primera fila son los títulos. El sistema controla por TASA; CUENTA; AÑO; CUOTA. Archivo sugerido: "i_deuda.csv"</p>

	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->fileFieldGroup($model,'archivo',array('widgetOptions'=>array('htmlOptions'=>array('name'=>'archivo[]')))); ?>

	<?php echo $form->checkboxGroup($model,'archivos_subidos'); ?>

<div class="form-actions">
	<?php 
	echo CHtml::hiddenField('formulario', 'cuotas-form');
	$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>'Importar',
		)); ?>
</div>

<?php $this->endWidget(); ?>