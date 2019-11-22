<?php

namespace Juuin\HttpClient;

use Juuin\HttpClient\Contracts\Request;
use Juuin\HttpClient\Contracts\Response;
use Juuin\HttpClient\Contracts\Configurable;
use Juuin\HttpClient\Exceptions\UrlNotSetException;
use Juuin\HttpClient\Exceptions\WrongMethodException;

class HttpClient implements Configurable, Request, Response
{
    private $url, $method, $headers, $params;

    /** @var $response HttpClientResponse */
    private $response;

    /**
     * Set the url of the request
     *
     * @param string $url
     * @return HttpClient
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
        $method = strtoupper($method);

        if (!in_array($method, ['POST', 'GET'])) {
            throw new WrongMethodException('Method should be GET or POST');
        }

        $this->method = $method;

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
        if (array_keys($headers) !== range(0, count($headers) - 1)) {
            $temp = [];
            foreach ($headers as $key => $value) {
                array_push($temp, "$key: $value;");
            }
            $headers = $temp;
        }

        $this->headers = $headers;

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
        $this->params = $params;

        return $this;
    }

    /**
     * Set the configs of the request and send
     *
     * @return HttpClient
     */
    public function send()
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($this->headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        }

        if ($this->method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->params);
        } else {
            $this->method = 'GET';
        }

        if ($this->method == 'GET') {
            $this->url .= (!is_null($this->params) ? '?' . http_build_query($this->params) : '');
        }

        if (is_null($this->url)) {
            throw new UrlNotSetException('Please set url before sending requests');
        }

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        $body = curl_exec($curl);
        $info = curl_getinfo($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $this->response = new HttpClientResponse($info, $body, $error);

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