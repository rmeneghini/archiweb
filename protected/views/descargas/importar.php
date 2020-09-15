<?php
$this->breadcrumbs=array(
	'Descargas'=>array('index'),
	'Importar',
);
$this->parametros=array(
	'titulo'=>'Importar Descargas',
);

$this->menu=array(
	array('label'=>'Listar Descargas', 'url'=>array('index')),
	array('label'=>'Administrar Descargas', 'url'=>array('admin')),
);
?>

<h1>Importar Descargas</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'persona-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well','enctype'=>'multipart/form-data'),
)); ?>

<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<p class="help-block">El orden de los campos del txt debe ser el siguiente. Pref,C. Porte,T,N.Vagon,Fecha CP,Fec Venc,C.E.E. Nro,C.T.G.,CUIT Tit., Titular,CUIT Inter.,Intermediario,CUIT Rem.C.,Remitente Comercial,Cod, Especie,Contrato ,Oncca,Procedencia,Provincia,C.Post, K.B.Pr ,K.T.Pr, K.N.Pr,Cos.,Ca,%Humed. ,CUIT Corre.,Corredor,CUIT Entreg,Entregador,CUIT Desti.,Destinatario,CUIT Dest.,Destino,Nro.Pl, Planta,CUIT Transp, Transportista,Patente,PatAcop,Km a rec,TarxTon,Cuit Chofer,Nombre Chofer,Fecha Ar,Fecha De,H.Ar,H.De,Bruto,Tara,Neto,Merma,Neto Apl,Analisis,Cupo Alfanumerico y se asumen que la primera fila son los títulos.</p>

	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->fileFieldGroup($model,'archivo',array('widgetOptions'=>array('htmlOptions'=>array('name'=>'archivo[]')))); ?>

<div class="form-actions">
	<?php 
	echo CHtml::hiddenField('formulario', 'descarga-form');
	$this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>'Importar',
		)); ?>
</div>

<?php $this->endWidget(); ?>