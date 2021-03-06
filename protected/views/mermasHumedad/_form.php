<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'mermas-humedad-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>	
		<?php echo $form->dropDownListGroup($model,'producto',array('widgetOptions'=>array('data'=>Producto::getProductos('id'),'htmlOptions'=>array()))); ?>	
		<?php echo $form->textFieldGroup($model,'porcentaje_humedad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>	
		<?php echo $form->textFieldGroup($model,'valor',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
