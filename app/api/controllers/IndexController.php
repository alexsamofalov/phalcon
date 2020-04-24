<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

namespace System\ApiControllers;

use System\API\Response;

class IndexController extends ControllerAbstract
{
    public function index()
    {
        return (new Response())->success('System API');
    }
}