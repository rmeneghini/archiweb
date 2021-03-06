<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'analisis-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model,'rubro',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'carta_porte',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->dropDownListGroup($model, 'producto', array('widgetOptions' => array('data' => Producto::getProductos('id'), 'htmlOptions' => array()))); ?>
	<?php echo $form->switchGroup($model, 'bonifica_rebaja',array(
				'widgetOptions' => array(
					'options' => array(
				        'onText' => 'Bonifica',
				        'offText' => 'Rebaja',
				    ),
					'events'=>array(
						'switchChange'=>'js:function(event, state) {
						  //console.log(this); // DOM element
						  //console.log(event); // jQuery event						  
						  //console.log(state); // true | false
						}'
					)
				)
			)
		); ?>	
	<?php echo $form->textFieldGroup($model,'valor',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
