<?php

namespace Juuin\HttpClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Juuin\HttpClient\HttpClient setUrl($url);
 * @method static \Juuin\HttpClient\HttpClient setMethod($method = 'GET');
 * @method static \Juuin\HttpClient\HttpClient setHeaders(array $headers);
 * @method static \Juuin\HttpClient\HttpClient setParams(array $params);
 * @method static \Juuin\HttpClient\HttpClient setSslKey($path);
 * @method static \Juuin\HttpClient\HttpClient setSslCert($path);
 * @method static \Juuin\HttpClient\HttpClient setBasicAuth($username, $password);
 * @method static \Juuin\HttpClient\HttpClient setTimeout($timeMs = 0);
 * @method static \Juuin\HttpClient\HttpClient send();
 * @method static \Juuin\HttpClient\HttpClientResponse response();
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