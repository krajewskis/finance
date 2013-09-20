<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 15:19
 * To change this template use File | Settings | File Templates.
 */

require_once 'autoload.php';

use Framework\Application;

error_reporting(E_ALL);
ini_set('display_errors',true);

mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Prague');

// set_error_handler( array( '\Framework\Error', 'captureError' ) );
// set_exception_handler( array( '\Framework\Error', 'captureException' ) );
// register_shutdown_function(array( 'Framework/Error', 'captureShutdown' ));


Application::Run();