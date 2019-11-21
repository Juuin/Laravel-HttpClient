<?php

namespace Juuin\HttpClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Juuin\HttpClient\HttpClient setUrl($url)
 * @method static \Juuin\HttpClient\HttpClient setMethod($method = 'GET')
 * @method static \Juuin\HttpClient\HttpClient setHeaders(array $headers)
 * @method static \Juuin\HttpClient\HttpClient setParams(array $params)
 * @method static \Juuin\HttpClient\HttpClient send($configs = [])
 * @method static \Juuin\HttpClient\HttpClientResponse response()
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