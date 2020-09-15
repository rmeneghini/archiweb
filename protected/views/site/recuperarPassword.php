<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->pageTitle=Yii::app()->name . ' - Recuperar Contraseña';
$this->breadcrumbs=array(
	'Recuperar Contraseña',
);

?>
<h1>Recuperar Contraseña</h1>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'recuperar-form',
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
		<?php echo $form->textFieldGroup($model,'email'); ?>		
	</div>      

	<div class="col-xs-10 buttons">
		<?php echo CHtml::submitButton('Recuperar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->