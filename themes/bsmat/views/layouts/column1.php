<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php 
	//aca imprimimos la columna izquierda, seria el contenido principal del sio, tipo "main" 
	//le saque el article, porque dentro del jumbotron se rompia, ademas la etiqueta "article", google la indexa como info!
?>
<!-- <article class="col-xs-12 col-sm-12 col-md-12"> -->
<div class="the-content row">
	<?php echo $content; ?>
</div>
<!-- </article>  -->
<?php $this->endContent(); ?>