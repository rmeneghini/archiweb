<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contáctenos';
$this->breadcrumbs=array(
	'Contacto',
);
?>

<h1>Contáctenos</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('booster.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<p>
Si tiene consultas comerciales u otras preguntas, por favor, rellene el siguiente formulario para contactarse con nosotros. Gracias.
</p>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'contact-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldGroup($model,'name'); ?>

    <?php echo $form->textFieldGroup($model,'email'); ?>

    <?php echo $form->textFieldGroup($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

    <?php echo $form->textAreaGroup($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaGroup($model,'verifyCode',array(
            'hint'=>'Por favor, introduzca las letras que se muestran en la imagen de arriba.<br />Las letras no distinguen entre mayúsculas y minúsculas',
        )); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton',array(
            'buttonType'=>'submit',
            'label'=>'Enviar',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>