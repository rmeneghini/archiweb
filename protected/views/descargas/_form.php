<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'descargas-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation' => true,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
	<?php 
		echo $form->datePickerGroup($model,'fecha_carga',array('widgetOptions'=>array('options'=>array('endDate'=>'-1Y','todayHighlight'=>true),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', )); 
	?>
	<?php echo $form->textFieldGroup($model,'carta_porte',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->datePickerGroup($model,'fecha_carta_porte',array('widgetOptions'=>array('options'=>array('endDate'=>'-1Y','todayHighlight'=>true),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',)); ?>
	<?php echo $form->textFieldGroup($model,'cuit_titular',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	
	<?php echo $form->dropDownListGroup($model,'producto',array('widgetOptions'=>array('data'=>Producto::getProductos('id'),'htmlOptions'=>array()))); ?>	

	<?php echo $form->textFieldGroup($model,'cod_postal',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>6)))); ?>
	<?php echo $form->textFieldGroup($model,'kg_brutos_procedencia',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'kg_tara_procedencia',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'kg_netos_procedencia',array('widgetOptions'=>array('htmlOptions'=>array('readOnly'=>true)))); ?>
	<?php echo $form->textFieldGroup($model,'calidad',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>3)))); ?>
	<?php echo $form->textFieldGroup($model,'porcentaje_humedad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'merma_humedad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'cuit_corredor',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'cuit_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'chasis',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>7)))); ?>
	<?php echo $form->textFieldGroup($model,'acoplado',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>7)))); ?>
	<?php echo $form->datePickerGroup($model,'fecha_arribo',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', )); ?>
	<?php echo $form->datePickerGroup($model,'fecha_descarga',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', )); ?>
	<?php echo $form->textFieldGroup($model,'kg_brutos_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'kg_tara_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'kg_netos_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'kg_merma_total',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'otras_mermas',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'neto_aplicable',array('widgetOptions'=>array('htmlOptions'=>array('readOnly'=>true)))); ?>
	<?php echo $form->textFieldGroup($model,'analisis',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>
	<?php echo $form->textFieldGroup($model,'porcentaje_zaranda',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'merma_zaranda',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'fumigado',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'cuit_intermediario',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'cuit_remitente_comercial',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
