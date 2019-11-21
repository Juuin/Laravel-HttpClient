<?php

namespace Juuin\HttpClient;

use Juuin\HttpClient\Contracts\Request;
use Juuin\HttpClient\Contracts\Response;
use Juuin\HttpClient\Contracts\Configurable;

class HttpClient implements Configurable, Request, Response
{
    private $curl;

    private $url, $response;

    /**
     * Set the url of the request
     *
     * @param string $url
     * @return HttpClient
     */
    public function setUrl($url)
    {
        $this->curl = curl_init();

        $this->url = $url;

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->curl, CURLOPT_URL, $this->url);

        return $this;
    }

    /**
     * Set the method of the request
     *
     * @param string $method
     * @return HttpClient
     */
    public function setMethod($method = 'GET')
    {
        if ($method == 'POST') {
            curl_setopt($this->curl, CURLOPT_POST, true);
        }

        return $this;
    }

    /**
     * Set the headers of the request
     *
     * @param array $headers
     * @return HttpClient
     */
    public function setHeaders(array $headers)
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);

        return $this;
    }

    /**
     * Set the params of the request
     *
     * @param array $params
     * @return HttpClient
     */
    public function setParams(array $params)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);

        return $this;
    }

    /**
     * Set the configs of the request and send
     *
     * @param array $configs
     * @return HttpClient
     */
    public function send($configs = [])
    {
        $info = curl_getinfo($this->curl);
        $error = curl_error($this->curl);
        $response = curl_exec($this->curl);

        $this->response = new HttpClientResponse($info, $response, $error);

        curl_close($this->curl);

        return $this;
    }

    /**
     * Get the response
     *
     * @return HttpClientResponse
     */
    public function response()
    {
        return $this->response;
    }
}