<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 15:19
 * To change this template use File | Settings | File Templates.
 */

use Framework\Router;

error_reporting(E_ALL);
ini_set('display_errors',true);

function pa($pa) {
	echo '<pre>';
	print_r($pa);
	echo '</pre>';
}

function __autoload($class) {
	require_once $class.'.php';
}

mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Prague');

// set_error_handler( array( '\Framework\Error', 'captureError' ) );
// set_exception_handler( array( '\Framework\Error', 'captureException' ) );
// register_shutdown_function(array( 'Framework/Error', 'captureShutdown' ));


Router::Initialize();