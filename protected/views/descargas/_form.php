<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'descargas-form',
	'enableAjaxValidation'=>false,
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
	<?php /* 
	//echo $form->textFieldGroup($model,'producto',array('widgetOptions'=>array('htmlOptions'=>array()))); 
	// muestro el input para seleccionar el producto        
	$onClickbuscarProd="jQuery('#buscarProd').dialog('open'); return false;"; 
	echo $form->textFieldGroup($model,'producto',array('widgetOptions'=>array('htmlOptions'=>array('readonly'=>'readonly')),'prepend'=>'<span id="nombre_producto"></span>','append'=>'<i style="cursor:pointer;" class="glyphicon glyphicon-search" onclick="'.$onClickbuscarProd.'"></i>')); 	
	
	// El siguiente código es para mostrar el visual assit        
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>'buscarProd',
				'options'=>array(
						'title'=>'Seleccionar Producto',
						'width'=>'52%',
						'height'=>'470',
						'autoOpen'=>false,
						'resizable'=>true,
						'modal'=>true,
						'overlay'=>array(
							'backgroundColor'=>'#000',
							'opacity'=>'0.5'
						),
						'buttons'=>array(
							'OK'=>'js:function(){                                                       
								$("#Descargas_producto").val(jQuery.fn.yiiGridView.getChecked("productos-grid", "chk"));
								$("#nombre_producto").html(jQuery((jQuery("#productos-grid table tbody tr.selected").children()[1])).html());                                    
								//console.log(jQuery((jQuery("#llamado-examen-grid table tbody tr.selected").children()[2])).html());                                    
								//$("#InscripcionExamen_id_alumno").change();
								$(this).dialog("close");
							}',
							'Cancel'=>'js:function(){$(this).dialog("close");}',
						),
					),
					));
		$this->renderPartial('/producto/_select',array('model'=>$modelProducto,'dataProvider'=>$modelProducto->search(),'noCerrados'=>true));
	$this->endWidget('zii.widgets.jui.CJuiDialog');*/
	?>
	<?php echo $form->dropDownListGroup($model,'producto',array('widgetOptions'=>array('data'=>Producto::getProductos('id'),'htmlOptions'=>array()))); ?>	

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
	<?php echo $form->datePickerGroup($model,'fecha_arribo',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', )); ?>
	<?php echo $form->datePickerGroup($model,'fecha_descarga',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', )); ?>
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
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
