<?php
$this->breadcrumbs=array(
	'Personas/Contribuyentes'=>array('index'),
	'Importar',
);
$this->parametros=array(
	'titulo'=>'Importar Personas/Contribuyentes',
);

$this->menu=array(
	array('label'=>'Listar Personas/Contribuyentes', 'url'=>array('index')),
	array('label'=>'Administrar Personas/Contribuyentes', 'url'=>array('admin')),
);
?>

<h1>Importar Persona/Contribuyentes</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'persona-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well','enctype'=>'multipart/form-data'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<p class="help-block">El orden de los campos del csv debe ser el siguiente. NUMERO; NOMBRE; DIREC; NRO; DPTO; PISO; BARRIO; LOCAL; CDPOS; PROV; NACION; USUARIO; PASSWORD y se asumen que la primera fila son los títulos. El sistema controla por NUMERO.</p>

	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->fileFieldGroup($model,'archivo',array('widgetOptions'=>array('htmlOptions'=>array('name'=>'archivo[]')))); ?>

<div class="form-actions">
	<?php 
	echo CHtml::hiddenField('formulario', 'persona-form');
	$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>'Importar',
		)); ?>
</div>

<?php $this->endWidget(); ?>