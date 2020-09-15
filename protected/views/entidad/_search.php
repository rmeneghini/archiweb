
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
)); ?>



	
	<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'cuit',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>12)))); ?>



	
	<?php echo $form->textFieldGroup($model,'tipo_entidad',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'exportar',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'razonSocial',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>



	
	<?php echo $form->textFieldGroup($model,'direccion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>110)))); ?>



	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Buscar',
		)); ?>

	</div>

<?php $this->endWidget(); ?>

