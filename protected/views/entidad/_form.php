<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'entidad-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model,'cuit',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>12)))); ?>	
	<?php echo $form->dropDownListGroup($model,'tipo_entidad',array('widgetOptions'=>array('data'=>TipoEntidad::getTipoEntidad('id'),'htmlOptions'=>array()))); ?>		
	<?php echo $form->switchGroup($model, 'exportar',array(
				'widgetOptions' => array(
					'options' => array(
				        'onText' => 'SI',
				        'offText' => 'NO',
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
	<?php echo $form->textFieldGroup($model,'razonSocial',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>
	<?php echo $form->textFieldGroup($model,'direccion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
