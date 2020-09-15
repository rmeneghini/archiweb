<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>true,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->textFieldGroup($model,'nombre',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>60)))); ?>

	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>100)))); ?>

	<?php echo $form->textFieldGroup($model,'hash_activacion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>150,'disabled' => true)))); ?>

	<?php echo $form->radioButtonListGroup(	$model,	'estado',array('inline'=>true,'widgetOptions' => array('data' => array(0=>'Deshabilitado',1=>'Habilitado',)))); ?>	
	<div class="form-group">
		<label class="col-sm-3 control-label" for="Usuario_rol">Rol</label>
		<div class="col-sm-9">	
		<?php $roles=array('cliente'=>'Cliente','admin'=>'Usuario para carga de datos');
		if(Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)){
			$roles['super']='Super usuario';
		}
		?>
		<?php echo CHtml::dropDownList('rol', $rol, array(
							'Roles'=>$roles,
							),array('class'=>'form-control'));?>
		</div>
	</div>

	<?php if(isset($persona)){echo CHtml::hiddenField('persona-asociar', $persona);} ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
