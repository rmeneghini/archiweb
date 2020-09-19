<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'persona-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldGroup($model,'dni',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php echo $form->textFieldGroup($model,'nombre',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>100)))); ?>
	<?php echo $form->textFieldGroup($model,'apellido',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>80)))); ?>
	<?php echo $form->textFieldGroup($model,'direccion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>120)))); ?>
	<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>70)))); ?>
	<?php //echo $form->textFieldGroup($model,'telefono_1',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>25)))); ?>
	<?php //echo $form->textFieldGroup($model,'telefono_2',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>25)))); ?>
	<?php //echo $form->datePickerGroup($model,'fecha_nac',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>
	<?php //echo $form->textFieldGroup($model,'id_usuario',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php //echo $form->textFieldGroup($model,'id_localidad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	<?php $htmlOptions=array('ajax'=>array(
                            		'url'=>$this->createUrl('provincia/provinciasPorPais'),
                            		'type'=>'POST',
                            		'update'=>'#CompletarRegistroForm_provincia',
                        			),
								'class'=>'form-control',
                    );
                ?>
     <div class="form-group">
		<label class="col-sm-3 control-label" for="pais">Pais</label>
		<div class="col-sm-9">
    <?php echo CHtml::dropDownList('pais', $pais, Pais::getPaises('id'),$htmlOptions); ?>
	</div>
	</div>
	<?php $htmlOptions=array(
                        'ajax'=>array(
                            'url'=>$this->createUrl('localidad/ciudadesPorProvincia'),
                            'type'=>'POST',
                            'update'=>'#Persona_id_localidad',                            
                        ),  
                        'class'=>'form-control',                      
                        'options' => array('6'=>array('selected'=>true)),
                    );
                ?>
     <div class="form-group">
		<label class="col-sm-3 control-label" for="provincia">Provincia</label>
		<div class="col-sm-9">	
	<?php echo CHtml::dropDownList('provincia', null, Provincia::getProvincias('id'),$htmlOptions); ?>         
		</div>
	</div>
    
	<?php echo $form->dropDownListGroup($model,'id_localidad',array('widgetOptions'=>array('data'=>Localidad::getLocalidades('id'),'htmlOptions'=>array()))); ?>
	
	
	<?php echo $form->textFieldGroup($model,'telefono_1',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>25)))); ?>
	<?php echo $form->textFieldGroup($model,'telefono_2',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>25)))); ?>
	
	<?php echo $form->datePickerGroup($model,'fecha_nac',array('widgetOptions'=>array(
			'options'=>array('format'=>'dd-mm-yyyy',),
			'events'=>array('changeDate' => 'js:function() {$(this).datepicker("hide");}'),
			'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); 
	 ?>
	
	<?php //echo $form->textFieldGroup($model,'id_usuario',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>
	
<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>
