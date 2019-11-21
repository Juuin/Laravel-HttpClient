<?php

namespace Juuin\HttpClient\Contracts;

use Juuin\HttpClient\HttpClient;

interface Request
{
    /**
     * Set the configs of the request and send
     *
     * @param array $configs
     * @return HttpClient
     */
    public function send($configs = []);
}