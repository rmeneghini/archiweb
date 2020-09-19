
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type' => 'horizontal',
)); ?>



	
	<?php echo $form->textFieldGroup($model,'id',array('widgetOptions'=>array('htmlOptions'=>array()))); ?>



	
	<?php echo $form->textFieldGroup($model,'cuit',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>12)))); ?>



	
	<?php echo $form->textFieldGroup($model,'razon_social',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>150)))); ?>



	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Buscar',
		)); ?>

	</div>

<?php $this->endWidget(); ?>

