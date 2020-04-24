<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

$app->after(
    function () use ($app) {

        // Getting the return value of method
        $return = $app->getReturnedValue();

        if (!($return instanceof \System\API\Response)) {
            throw new Exception('Bad Response');
        }

        $app->response->setContentType('application/json', 'utf-8');

        if ($return->isError()){
            if ($app->request->isPost() || $app->request->isPut()){
                $app->response->setStatusCode('422', 'Unprocessable Entity');
            }else {
                $app->response->setStatusCode('400', 'Bad Request');
            }
        }else {
            $app->response->setStatusCode('200', 'OK');
        }

        // set response content
        $app->response->setContent((new \System\API\ResponseFormat\JSON())->format($return));

        // Sending response to the client
        $app->response->send();
    }
);

$app->before(
    function () use ($app,$acl) {
        // CORS
        $origin = $app->request->getHeader("ORIGIN") ? $app->request->getHeader("ORIGIN") : '*';

        $app->response->setHeader("Access-Control-Allow-Origin", $origin)
            ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization')
            ->setHeader("Access-Control-Allow-Credentials", true);

        return true;
    }
);

