<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

namespace System\API;

/**
 * Interface ResponseFormatterInterface
 * @package System\API
 */
interface ResponseFormatterInterface
{
    /**
     * @param Response $response
     * @return string
     */
    function format(Response $response):string;
}