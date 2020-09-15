
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
)); ?>



	
	<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->datePickerGroup($model,'fecha_carga',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>



	
	<?php echo $form->textFieldGroup($model,'carta_porte',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->datePickerGroup($model,'fecha_carta_porte',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>



	
	<?php echo $form->textFieldGroup($model,'cuit_titular',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'producto',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'cod_postal',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>6)))); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_brutos_procedencia',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_tara_procedencia',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_netos_procedencia',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'calidad',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>3)))); ?>



	
	<?php echo $form->textFieldGroup($model,'porcentaje_humedad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'merma_humedad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'cuit_corredor',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'cuit_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'chasis',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>7)))); ?>



	
	<?php echo $form->textFieldGroup($model,'acoplado',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>7)))); ?>



	
	<?php echo $form->datePickerGroup($model,'fecha_arribo',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>



	
	<?php echo $form->datePickerGroup($model,'fecha_descarga',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_brutos_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_tara_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_netos_destino',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'kg_merma_total',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'otras_mermas',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'neto_aplicable',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'analisis',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>



	
	<?php echo $form->textFieldGroup($model,'porcentaje_zaranda',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'merma_zaranda',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'fumigado',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'usuario',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'analisis_finalizado',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Buscar',
		)); ?>

	</div>

<?php $this->endWidget(); ?>

