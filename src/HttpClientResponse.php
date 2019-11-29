<?php

namespace Juuin\HttpClient;

use JsonSerializable;

class HttpClientResponse implements JsonSerializable
{
    private $info, $body, $error;

    public function __construct($info, $body, $error = null)
    {
        $this->info = $info;
        $this->body = $body;
        $this->error = $error;
    }

    public function hasError()
    {
        return (!is_null($this->error) && !empty($this->error)) || $this->getHttpCode() != 200;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHttpCode()
    {
        return $this->info['http_code'];
    }

    public function toArray()
    {
        return json_decode($this->getBody(), true);
    }

    public function jsonSerialize()
    {
        return [
            'info' => $this->info,
            'body' => $this->body,
            'error' => $this->error
        ];
    }
}