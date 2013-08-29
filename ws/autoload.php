<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krajewski
 * Date: 28.8.13
 * Time: 15:34
 * To change this template use File | Settings | File Templates.
 */

spl_autoload_register(function ($class) {
	include $class . '.php';
});

require_once __DIR__ . '/../vendor/autoload.php';