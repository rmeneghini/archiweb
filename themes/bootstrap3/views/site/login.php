<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Por favor, rellene el siguiente formulario con sus datos de acceso:</p>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	
	<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->textFieldGroup($model,'username'); ?>

	<?php echo $form->passwordFieldGroup($model,'password'); ?>

	<?php echo $form->checkboxGroup($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Login',
        )); ?>
	</div>
	<?php //echo CHtml::link('Recuperar contraseña',array('site/recuperarPassword')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
