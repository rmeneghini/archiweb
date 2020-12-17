<?php
/* @var $this SiteController */

/* @var $model ContactForm */

/* @var $form TbActiveForm */


$this->pageTitle = Yii::app()->name . ' - Contáctenos';

$this->breadcrumbs = array(
    'Contacto',
);
?>



<div class="container">
    <h1>Contáctenos</h1>
    <div class="container">
        <?php if (Yii::app()->user->hasFlash('contact')): ?>

            <?php
            $this->widget('booster.widgets.TbAlert', array(
                'alerts' => array('contact'),
            ));
            ?>

        <?php else: ?>
            <?php
            $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
                'id' => 'contact-form',
                'type' => 'horizontal',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),));
            ?>

            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldGroup($model, 'name'); ?>

            <?php echo $form->textFieldGroup($model, 'email'); ?>

            <?php echo $form->textFieldGroup($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>

            <?php echo $form->textAreaGroup($model, 'body', array('rows' => 6, 'class' => 'span8')); ?>

            <?php if (CCaptcha::checkRequirements()): ?>

                <?php
                echo $form->captchaGroup($model, 'verifyCode', array(
                    'hint' => 'Introduzca el captcha.',
                ));
                ?>

            <?php endif; ?>

            <div class="form-actions">

                <?php
                $this->widget('booster.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'label' => 'Enviar',
                ));
                ?>

            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>

<?php endif; ?>