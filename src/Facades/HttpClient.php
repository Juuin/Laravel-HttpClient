<?php

namespace Juuin\HttpClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \Juuin\HttpClient\HttpClient setUrl($url)
 * @method \Juuin\HttpClient\HttpClient setMethod($method = 'GET')
 * @method \Juuin\HttpClient\HttpClient setHeaders(array $headers)
 * @method \Juuin\HttpClient\HttpClient setParams(array $params)
 * @method \Juuin\HttpClient\HttpClient send($configs = [])
 * @method \Juuin\HttpClient\HttpClientResponse response()
 */
class HttpClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'HttpClient';
    }
}