<?php

namespace Juuin\HttpClient;

use JsonSerializable;

class HttpClientResponse implements JsonSerializable
{
    private $info, $response, $error;

    public function __construct($info, $response, $error = null)
    {
        $this->info = $info;
        $this->response = $response;
        $this->error = $error;
    }

    public function getUrl()
    {
        return $this->info['url'];
    }

    public function getContent()
    {
        return $this->response;
    }

    public function getHttpCode()
    {
        return $this->info['http_code'];
    }

    public function getRemoteIp()
    {
        return $this->info['primary_ip'];
    }

    public function getLocalIp()
    {
        return $this->info['local_ip'];
    }

    public function hasError()
    {
        return !is_null($this->error) && !empty($this->error);
    }

    public function getError()
    {
        return $this->error;
    }

    public function toArray()
    {
        return json_decode($this->response, true);
    }

    public function jsonSerialize()
    {
        return [
            'info' => $this->info,
            'content' => $this->response,
            'error' => $this->error
        ];
    }
}