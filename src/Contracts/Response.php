<?php

namespace Juuin\HttpClient\Contracts;

use Juuin\HttpClient\HttpClientResponse;

interface Response
{
    /**
     * Get the response
     *
     * @return HttpClientResponse
     */
    public function response();
}