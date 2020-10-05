<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/sistema.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/utilidades.js" type="text/javascript" charset="utf-8" ></script>
	<title><?php echo CHtml::encode(isset($this->parametros['titulo'])?Yii::app()->name.' - '.$this->parametros['titulo']:$this->pageTitle); ?></title>
	<?php //Yii::app()->bootstrap->getBooster(); ?>
	<?php Yii::app()->bootstrap->registerYiiCss(); ?>
	<?php Yii::app()->bootstrap->registerJQueryCss(); ?>
	<!-- tiporafias, traer a local -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400|Roboto:400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<!-- Latest compiled and minified CSS -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">-->
	<!-- Optional theme -->
	<!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-theme.min.css">-->
</head>
<body>
	<!-- <div class="container"> -->
		<!-- <div class="row"> -->
			<header>
				<?php $this->widget('booster.widgets.TbNavbar',array(
					//'brand' => Yii::app()->name,
					'brand'=>CHtml::image(Yii::app()->getBaseUrl().'/images/icono.png','logo',array('style'=>'display: inline')).' '. Yii::app()->name,
					'fixed' => false,
					'fluid' => true,
					'items'=>array(
						array(
							'class'=>'booster.widgets.TbMenu',
							// 'type' => 'navbar',
							'htmlOptions'=>array('class'=>'nav navbar-top-links navbar-right'),
							'items'=>array(
								//array('label'=>'Inicio', 'url'=>array('/site/index')),
								//array('label'=>'Acerca de', 'url'=>array('/site/page', 'view'=>'about')),
								array('label'=>'Contacto', 'url'=>array('/site/contact')),
								//array('label'=>'Seguridad', 'url'=>array('/seguridad/'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
								// array('label'=>'Registrarse', 'url'=>array('/site/registro'), 'visible'=>Yii::app()->user->isGuest),
								array('label'=>'Ingresar', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),								
								array('label'=>'Acciones', 'url'=>'#', 'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id),
									'items'=>array(
										array('label'=>'Usuarios', 'url'=>array('/usuario/admin'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
										array('label'=>'Personal/Contribuyentes','url'=>array('/persona/admin'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
										// array('label'=>'Paises', 'url'=>array('/pais/')),
										array('label'=>'Provincias', 'url'=>array('/provincia/'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
										array('label'=>'Localidades', 'url'=>array('/localidad/')),
										array('label'=>'Entidades', 'url'=>array('/entidad/admin')),
										array('label'=>'Empresas', 'url'=>array('/empresa/admin'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
										array('label'=>'Productos', 'url'=>array('/producto/admin')),
										array('label'=>'Rubro-Valor', 'url'=>array('/rubrocalculovalor/admin'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
										array('label'=>'Análisis', 'url'=>array('/analisis/admin'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
										)),
								array('label'=>'Panel', 'icon'=>'cog','url'=> (Yii::app()->authManager->isAssigned('admin',Yii::app()->user->id))? array('descargas/admin'): array('descargas/admin'), 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id)),
								array('label'=>' ', 'icon'=>'user', 'url'=>'#', 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id),
									'items'=>array(
										array('label'=>'Cambiar Contraseña', 'icon'=>'cog','url'=>array('site/cambiarPassword'), 'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)),
										array('label'=>'Conf. Constantes', 'icon'=>'cog','url'=>array('configuracion/admin'), 'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)),
												//array('label'=>'Datos Personales', 'icon'=>'list-alt','url'=>array('site/completarRegistro'), 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id)),
										)),
										array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
								),
							),
						),
						));  ?>
					</header>
				<!-- </div> -->
			<!-- </div> -->
			<div class="container-fluid">
				<!-- <div class="jumbotron"> -->
				<!-- <section class="row"> -->
					<?php if(isset($this->breadcrumbs)):?>
						<?php $this->widget('booster.widgets.TbBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							)); ?><!-- breadcrumbs -->
						<?php endif?>
						<?php
					// Muestro si ocurrio un error
						if(($msgs=Yii::app()->user->getFlashes())!=null):?>
						<?php foreach ($msgs as $type => $message):?>
							<div class="alert alert-<?php echo $type;?>">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<h4><?php echo ucfirst($type == 'danger'?'Error':$type);?></h4>
								<?php echo $message;?>
							</div>
						<?php endforeach;?>
					<?php endif;?>
					<?php echo $content; ?>
				<!-- </section> -->
				<!-- </div> -->
			</div>
			<!-- <div class="container-fluid"> -->
				<!-- <div class="row"> -->
			<footer class="blog-footer">
				<!-- <div class="row"> -->
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="widget-title">
								<h4>Enlaces</h4>
							</div>
							<div class="widget-content">
								<p><a href="#">Preguntas Frecuentes</a></p>
								<p><a href="#">Terminos y Condiciones</a></p>
								<p><a href="#">Contacto</a></p>
							</div>
						</div>
						<div class="col-md-8">							
							<div class="widget-content">
								<div class="imagenes-medios-de-pago">
									<div class="col-md-4">
										&nbsp;										
									</div>
									<div class="col-md-4">
										&nbsp;
									</div>
									<div class="col-md-4">
									<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="Cerealista Moldes" class="img-responsive">
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="row copyright">
						<!-- <div class="col-md-12"> -->
							<p class="text-muted">Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::link('Nosotros.','#', array('target'=>'_blank')); ?> - Todos los derechos reservados.</p>
						<!-- </div> -->
					</div>
				</div>
				<!-- </div> -->
			</footer>
				<!-- </div> -->
			<!-- </div> -->
			<!-- Latest compiled and minified JavaScript -->
<!-- no anda porque falta importar alguna libreria de Boots -->
<!-- 			<footer class="footer">
			      <div class="container">
			        <p class="text-muted">Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::link('Nosotros.','#', array('target'=>'_blank')); ?> - Todos los derechos reservados.</p>
			      </div>
			</footer> -->
			<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>-->
		</body>
		</html>
