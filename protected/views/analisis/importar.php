<?php
$this->breadcrumbs=array(
	'Análisis'=>array('index'),
	'Importar',
);
$this->parametros=array(
	'titulo'=>'Importar Análisis',
);

$this->menu=array(
	//array('label'=>'Listar Análisis', 'url'=>array('index')),
	array('label'=>'Administrar Análisis', 'url'=>array('admin')),
);
?>

<h1>Importar Análisis</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'analisis-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well','enctype'=>'multipart/form-data'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<p class="help-block">El orden de los campos del XML debe ser el siguiente. ....</p>

	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->fileFieldGroup($model,'archivo',array('widgetOptions'=>array('htmlOptions'=>array('name'=>'archivo[]')))); ?>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="Importar_config">Conf. Importación</label>
		<div class="col-sm-9">
	<?php $configs=array(1=>'Conf Importación 1',2=>'Conf Importación 2',3=>'Conf Importación 3');?>
		<?php echo CHtml::dropDownList('config', 0, array(
							'Configuraciones'=>$configs,
							),array('class'=>'form-control'));?>
		</div>
	</div>

<div class="form-actions">
	<?php 
	echo CHtml::hiddenField('formulario', 'descarga-form');
	$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>'Importar',
		)); ?>
</div>

<?php $this->endWidget(); ?>