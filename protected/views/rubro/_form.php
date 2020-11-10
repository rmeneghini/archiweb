<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'rubro-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model,'descripcion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>
	<?php echo $form->textFieldGroup($model,'valores',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>
	<?php echo $form->textFieldGroup($model,'conf_import1',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>30)))); ?>
	<?php echo $form->textFieldGroup($model,'conf_import2',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>30)))); ?>
	<?php echo $form->textFieldGroup($model,'conf_import3',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>30)))); ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
