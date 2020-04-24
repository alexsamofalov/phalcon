<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Mvc\Micro;
use Phalcon\DI\FactoryDefault;

/**
 * Create dependency injection object
 */
$di = new FactoryDefault();

/**
 * Include constants
 */
require __DIR__."/../../config/constants.php";

/**
 * Include Autoloader
 */
require APP_PATH . '/config/load.php';

//Load environment variables
\Dotenv\Dotenv::createImmutable(APP_PATH)->load();

/**
 * Include services
 */
include APP_PATH . "/config/services.php";

/**
 * Include cache config
 */
include APP_PATH . "/config/cache.php";

// create micro application
$app = new Micro();

$app->setDI($di);

// ACL
include APP_PATH . '/config/acl/api.php';

// Middleware
include APP_PATH . '/config/middleware.php';

// Routes
include APP_PATH . '/config/routes/api.php';

$app->handle();