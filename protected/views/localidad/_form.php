<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'localidad-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'nombre',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>90)))); ?>

	<?php echo $form->textFieldGroup($model,'codigo_postal',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>10)))); ?>

	<?php
            $htmlOptions=array(
               'class'=>'form-control',
               'name'=>'Localidad[pais]',
               'ajax'=>array(
                       'url'=>$this->createUrl('provinciasPorPais'),
                       'type'=>'POST',
                       'update'=>'#Localidad_provincia',
                        ),
                    );
    ?>	
    <div class="form-group"><label class="col-sm-3 control-label required" for="Localidad_pais">País <span class="required">*</span></label>
	    <div class="col-sm-9">
		<?php echo CHtml::dropDownList('pais', null, Pais::getPaises('id'),$htmlOptions); ?>
		</div>
	</div>

	<?php echo $form->dropDownListGroup($model,'provincia',array('widgetOptions'=>array('data'=>Provincia::getProvincias('id'),'htmlOptions'=>array()))); ?>
	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
