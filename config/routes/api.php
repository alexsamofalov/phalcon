<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

// Index routes
include APP_PATH . '/config/routes/api/index.php';

// Not found route
$app->notFound(
    function () use ($app) {
        $app->response->setStatusCode(404, "Not Found")->sendHeaders();
        return json_encode(['page not found']);
    }
);

// Options route
$app->options('/{catch:(.*)}', function() use ($app) {
    $app->response->setStatusCode(200, "OK")->send();
    return false;
});
