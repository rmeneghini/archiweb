<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(

	'action'=>Yii::app()->createUrl($this->route),

	'method'=>'get',

	'type' => 'horizontal',

)); ?>


		<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>


		<?php echo $form->textFieldGroup($model,'dni',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>


		<?php echo $form->textFieldGroup($model,'nombre',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>100)))); ?>


		<?php echo $form->textFieldGroup($model,'apellido',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>80)))); ?>


		<?php echo $form->textFieldGroup($model,'direccion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>120)))); ?>


		<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>70)))); ?>


		<?php echo $form->textFieldGroup($model,'telefono_1',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>25)))); ?>


		<?php echo $form->textFieldGroup($model,'telefono_2',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>25)))); ?>


		<?php echo $form->datePickerGroup($model,'fecha_nac',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array()), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>


		<?php echo $form->textFieldGroup($model,'id_usuario',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>


		<?php //echo $form->textFieldGroup($model,'id_localidad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>


	<div class="form-actions">

		<?php $this->widget('booster.widgets.TbButton', array(

			'buttonType' => 'submit',

			'context'=>'primary',

			'label'=>'Buscar',

		)); ?>
	</div>



<?php $this->endWidget(); ?>
