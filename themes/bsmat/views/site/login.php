<?php

	/* @var $this SiteController */

	/* @var $model LoginForm */

	/* @var $form CActiveForm  */

	$this->pageTitle=Yii::app()->name . ' - Login';

	$this->breadcrumbs=array(
		'Login',
	);
?>

<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
	<h1 class="text-center">Acceso de usuarios</h1>
	<!-- <p>Por favor, rellene el siguiente formulario con sus datos de acceso:</p> -->
	<br>
	<br>
	<div class="form">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
			'id'=>'login-form',
			'type'=>'horizontal',
			// 'htmlOptions' => array('class' => 'text-center'),
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
		<!-- <p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p> -->
		<?php echo $form->textFieldGroup($model,'username', array('wrapperHtmlOptions' => array('class' => 'text-center',))); ?>
		<!-- passwordFieldGroup($model, 'password', array(), array('hint' => 'Check keyboard layout')); ?> -->
		<?php echo $form->passwordFieldGroup($model,'password'); ?>
		<?php //echo $form->checkboxGroup($model,'rememberMe'); ?>
		<div class="form-actions">
			<br>
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'label'=>'Acceder',
			)); ?>
			</div>
			<br>
			<small><?php /*echo CHtml::link('Olvide mi contraseña',array('site/recuperarPassword')); */?></small>
			<?php $this->endWidget(); ?>			
	</div><!-- form -->
</div>
