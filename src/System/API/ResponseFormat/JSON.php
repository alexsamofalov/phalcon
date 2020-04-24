<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

namespace System\API\ResponseFormat;

use System\API\Response;
use System\API\ResponseFormatterInterface;

/**
 * Class JSON
 * @package System\API\ResponseFormat
 */
class JSON implements ResponseFormatterInterface
{
    /**
     * @param Response $response
     * @return string
     */
    function format(Response $response): string
    {
        $data = [
            'status' => $response->status()
        ];

        if ($response->isError()) {
            $data['error'] = $response->errorMessage();
        }else {
            $data['data'] = $response->data();
        }

        return json_encode($data,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}