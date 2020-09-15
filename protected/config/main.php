<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('booster', dirname(__FILE__).'/../extensions/YiiBooster-master/src');


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ARCHIWEB',
	//'theme'=>'bootstrap3',
	'theme'=>'bsmat',
    'language'=>'es',


	// preloading 'log' component
	'preload'=>array('log','bootstrap','booster'),//


	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),



	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

		*/

		'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'30013522',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1','::1'),
				'generatorPaths'=>array('booster.gii' ),
			),

	),



	// application components

	'components'=>array(

		

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'authTimeout' => 1200, //session de 20 minutos
		),

		// uncomment the following to enable URLs in path-format		

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'authManager'=>array(
                    'class'=>'CDbAuthManager',
                    'connectionID'=>'db',
                    'assignmentTable'=>'authassignment',
			        'itemTable'=>'authitem',
			        'itemChildTable'=>'authitemchild',
                    #'defaultRoles'=>array('user', 'datos', 'super')

        ),

		'bootstrap' => array(
            'class' => 'booster.components.Booster',
        ),

		



		// database settings are configured in database.php

		'db'=>require(dirname(__FILE__).'/database.php'),



		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),



		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),

				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/

			),

		),



	),



	// application-level parameters that can be accessed

	// using Yii::app()->params['paramName']

	'params'=>array(

		// this is used in contact page

		'adminEmail'=>'webmaster@example.com',
		'paisDefault'=>'Argentina',
		'provDefault'=>6,//Córdoba
		'locDefault'=>1,//Rio Cuarto
		'importar'=>array(
			'separador'=>';',
			),
		'municipalidad'=>array(
			'logo'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'LogoMuni.jpg',
			),
	),

);

