<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->pageTitle=Yii::app()->name . ' - Cambiar Contraseña';
$this->breadcrumbs=array(
	'Cambiar Contraseña',
);

?>
<h1>Cambiar Contraseña</h1>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'cambiar-password-form',
	'type'=>'horizontal',
        'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,        
        'clientOptions' => array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
        ),
)); ?>

	<p class="note">Los campos indicados con <span class="required">*</span> son requeridos.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="col-xs-10">
		<?php echo $form->passwordFieldGroup($model,'password_actual'); ?>		
	</div>  

    <div class="col-xs-10">
		<?php echo $form->passwordFieldGroup($model,'password_nuevo'); ?>
	</div>  

     <div class="col-xs-10">
		<?php echo $form->passwordFieldGroup($model,'repetir_password'); ?>
	</div>      

	<div class="col-xs-10 buttons">
		<?php echo CHtml::submitButton('Cambiar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->