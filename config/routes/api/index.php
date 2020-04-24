<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$account = new MicroCollection();

$account->setHandler(new \System\ApiControllers\IndexController());

// main page
$account->get('/','index');

$app->mount($account);