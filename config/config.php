<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Config;

// Application config
return new Config([
    'timezone' => 'America/Los_Angeles',
    'appid' => getenv('APPID'),
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'db',
        'username' => 'root',
        'password' => getenv('DBPASS'),
        'dbname' => getenv('DBNAME')
    ],
    'redis' => [
        'host' => 'cache',
        'port' => '6379',
        'auth' => ''
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'pluginsDir'     => APP_PATH . '/plugins/'
    ],
    'devtools' => [
        "loader" => APP_PATH . '/config/load.php'
    ],
    'environment'=>getenv('ENVIRONMENT'),
    'sendgrid' => [
        'key' => getenv('SENDGRID')
    ],
    'sentryio' => [
        'dns' => getenv('SENTRYIO')
    ]
]);