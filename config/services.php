<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
 * Register the global configuration as config
 */
$di->setShared('config', function () {
    $config = include APP_PATH . '/config/config.php';

    return $config;
});

/**
 * Database connection, master
 */
$di->set('db', function () {
    $config = $this->getConfig();
    return new DbAdapter([
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ]
    ]);
});
