<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'empresa-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation' => true,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model,'cuit',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>12)))); ?>
	<?php echo $form->textFieldGroup($model,'razon_social',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>150)))); ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
