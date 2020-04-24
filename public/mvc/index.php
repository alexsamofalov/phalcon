<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

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

// Register the default dispatcher's namespace for controllers
$di->set(
    'dispatcher',
    function () {
        $dispatcher = new Dispatcher();

        $eventsManager = new EventsManager();

        // Listen for events produced in the dispatcher using the Security plugin
        $eventsManager->attach(
            'dispatch:beforeExecuteRoute',
            new \System\Plugins\SystemSecurity()
        );

        // Listen to exceptions
        $eventsManager->attach(
            'dispatch:beforeException',
            new \System\Plugins\SystemError()
        );

        // Register controllers
        $dispatcher->setDefaultNamespace('System\SystemControllers');

        // Assign the events manager to the dispatcher
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }
);

// Register the view component
$di->set(
    'view',
    function () {
        $view = new View();

        $view->setViewsDir(APP_PATH . "/app/mvc/views/");

        return $view;
    }
);

$app = new Application();

$app->setDI($di);

$response = $app->handle();

$response->send();