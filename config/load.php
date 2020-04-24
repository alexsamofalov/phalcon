<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Loader;

$loader = new Loader();
/**
 * Registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'System\Models'      => APP_PATH.'/models',
    'System\SystemControllers' => APP_PATH.'/app/mvc/controllers',
    'System\ApiControllers' => APP_PATH.'/app/api/controllers',
    'System\Plugins' => APP_PATH.'/plugins',
]);

$loader->register();

// Load vendor classes
$loader_composer = require APP_PATH.'/vendor/autoload.php';

// Load system's classes
$loader_composer->add('System', APP_PATH.'/src/');