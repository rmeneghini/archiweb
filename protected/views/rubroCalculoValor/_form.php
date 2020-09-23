<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'rubro-calculo-valor-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>	
		<?php echo $form->dropDownListGroup($model,'producto',array('widgetOptions'=>array('data'=>Producto::getProductos('id'),'htmlOptions'=>array()))); ?>	
		<?php echo $form->dropDownListGroup($model,'rubro',array('widgetOptions'=>array('data'=>Rubro::getRubros('id'),'htmlOptions'=>array()))); ?>	
		
		<?php echo $form->textFieldGroup($model,'valor_desde',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
		<?php echo $form->textFieldGroup($model,'valor_hasta',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
		<?php echo $form->switchGroup($model, 'diferencia_valor_hasta',array(
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
		<?php echo $form->switchGroup($model, 'bonifica',array(
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
		<?php echo $form->textFieldGroup($model,'castiga_bonifica',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
		<?php echo $form->textFieldGroup($model,'adicionar_a_castiga_bonifica',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
		



<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
