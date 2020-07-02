<?php

namespace Juuin\HttpClient\Contracts;

use Juuin\HttpClient\HttpClient;

interface Configurable
{
    /**
     * Set the url of the request
     *
     * @param string $url
     * @return HttpClient
     */
    public function setUrl($url);

    /**
     * Set the method of the request
     *
     * @param string $method
     * @return HttpClient
     */
    public function setMethod($method = 'GET');

    /**
     * Set the headers of the request
     *
     * @param array $headers
     * @return HttpClient
     */
    public function setHeaders(array $headers);

    /**
     * Set the params of the request
     *
     * @param array $params
     * @return HttpClient
     */
    public function setParams(array $params);

    /**
     * Set the ssl key file path
     *
     * @param string $path
     * @return HttpClient
     */
    public function setSslKey($path);

    /**
     * Set the ssl cert file path
     *
     * @param string $path
     * @return HttpClient
     */
    public function setSslCert($path);

    /**
     * Set the ssl cert password
     *
     * @param string $password
     * @return HttpClient
     */
    public function setSslCertPassword($password);

    /**
     * @param $username
     * @param $password
     * @return HttpClient
     */
    public function setBasicAuth($username, $password);

    /**
     * @param int $timeMs
     * @return HttpClient
     */
    public function setTimeout($timeMs = 0);
}