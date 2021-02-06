<?php

/* 
	$dbhost = 'localhost';
	$dbuser = 'c1840948_aw';
	$dbpass = 'soBOfi00la';
	$dbname = 'c1840948_aw';

*/

// This is the database connection configuration.

return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

	'connectionString' => 'mysql:host=localhost;dbname=sistema_archiweb',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',

	/*'connectionString' => 'mysql:host=localhost;dbname=c1840948_aw',
	'emulatePrepare' => true,
	'username' => 'c1840948_aw',
	'password' => 'soBOfi00la',
	'charset' => 'utf8',*/
);