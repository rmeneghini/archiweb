<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="es" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/utilidades.js" type="text/javascript" charset="utf-8" ></script>

	<title><?php echo CHtml::encode(isset($this->parametros['titulo'])?Yii::app()->name.' - '.$this->parametros['titulo']:$this->pageTitle); ?></title>

	<?php //Yii::app()->bootstrap->getBooster(); ?>
	<?php Yii::app()->bootstrap->registerYiiCss(); ?>
	<?php Yii::app()->bootstrap->registerJQueryCss(); ?>	

	
	
</head>

<body>
	<div class="container">
		<div class="row">
			<header>
						
					<?php $this->widget('booster.widgets.TbNavbar',array(
						'brand' => Yii::app()->name,
				        'fixed' => false,
				    	'fluid' => true,
					    'items'=>array(
					        array(
					            'class'=>'booster.widgets.TbMenu',
					            'type' => 'navbar',
					            'items'=>array(
						                array('label'=>'Inicio', 'url'=>array('/site/index')),
						                array('label'=>'Acerca de', 'url'=>array('/site/page', 'view'=>'about')),
						                array('label'=>'Contacto', 'url'=>array('/site/contact')),                
						                array('label'=>'Seguridad', 'url'=>array('/seguridad/'),'visible'=>Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)),
						                array('label'=>'Registrarse', 'url'=>array('/site/registro'), 'visible'=>Yii::app()->user->isGuest),
						                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
						                array('label'=>'Acciones', 'url'=>'#', 'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id),
						                    'items'=>array(
						                    	array('label'=>'Usuarios', 'url'=>array('/usuario/'),'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)),
						                        array('label'=>'Personal/Contribuyentes','url'=>array('/persona/admin')),						                        
						                        array('label'=>'Paises', 'url'=>array('/pais/')),
						                        array('label'=>'Provincias', 'url'=>array('/provincia/')),
						                        array('label'=>'Localidades', 'url'=>array('/localidad/')),
						                        array('label'=>'Cuentas', 'url'=>array('/cuenta/'),'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)),
						                        array('label'=>'Tasas', 'url'=>array('/tasa/'),'visible'=>Yii::app()->authManager->checkAccess('admin',Yii::app()->user->id)),
						                )),
						                array('label'=>'Panel', 'icon'=>'cog','url'=>array('jugar/index'), 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id)),
						                array('label'=>' ', 'icon'=>'user', 'url'=>'#', 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id),
						                    'items'=>array(
						                    	array('label'=>'Cambiar Contraseña', 'icon'=>'cog','url'=>array('site/cambiarPassword'), 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id)),
						                    	array('label'=>'Datos Personales', 'icon'=>'list-alt','url'=>array('site/completarRegistro'), 'visible'=>Yii::app()->authManager->checkAccess('cliente',Yii::app()->user->id)),
						                )),
						                
						            ),
					        ),
					    ),
					));  ?>			
			</header>
		</div>
	</div>
	<div class="container sombra">
		<section class="row">
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
		</section>
		
	</div>
	<div class="container-fluid">
		<div class="row well">
			<footer class="col-xs-12">			
						Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::link('Nosotros.','#', array('target'=>'_blank')); ?>|
						Todos los derechos reservados.<br/>
						<?php //echo Yii::powered(); ?>			
			</footer>
		</div>
	</div>
<!-- Latest compiled and minified JavaScript -->

<!--<script src="<?php //echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>-->
</body>
</html>
