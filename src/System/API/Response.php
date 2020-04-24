<?php
/**
 * Copyright (c) 2020. Alex Samofalov <alexsamofalov86@gmail.com>
 */

namespace System\API;

/**
 * Class Response
 * @package System\API
 */
class Response
{
    /**
     * Error status
     */
    const statusError = 'error';

    /**
     * Success status
     */
    const statusSuccess = 'success';

    /**
     * Response status
     *
     * @var string
     */
    private $status;

    /**
     * Error message
     *
     * @var string|string[]|null
     */
    private $errorMessage;

    /**
     * Response data
     *
     * @var
     */
    private $data;

    /**
     * @param string|string[]|null $message
     * @return $this
     */
    public function error($message=null)
    {
        $this->status = $this::statusError;

        $this->errorMessage = $message;

        return $this;
    }

    /**
     * @param null|string|array $data
     * @return $this
     */
    public function success($data=null)
    {
        $this->status = $this::statusSuccess;

        $this->data = $data;

        return $this;
    }

    /**
     * @return bool
     */
    public function isError():bool
    {
        return ($this->status==$this::statusError)?true:false;
    }

    /**
     * @return string|string[]|null
     */
    public function errorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function status()
    {
        return $this->status;
    }
}