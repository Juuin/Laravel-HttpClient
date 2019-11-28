<?php

namespace Juuin\HttpClient;

use Illuminate\Http\Response;
use Juuin\HttpClient\Exceptions\UrlNotSetException;
use Juuin\HttpClient\Exceptions\WrongMethodException;
use Juuin\HttpClient\Exceptions\ErrorResponseException;
use Juuin\HttpClient\Contracts\Request as BaseRequest;
use Juuin\HttpClient\Contracts\Response as BaseResponse;
use Juuin\HttpClient\Contracts\Configurable as BaseConfigurable;

class HttpClient implements BaseConfigurable, BaseRequest, BaseResponse
{
    use HttpClientDebug;

    private $url, $method, $headers, $params;

    private $sslKey, $sslCert, $basicAuth;

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
     * Set the ssl key file path
     *
     * @param string $path
     * @return HttpClient
     */
    public function setSslKey($path)
    {
        $this->sslKey = $path;

        return $this;
    }

    /**
     * Set the ssl cert file path
     *
     * @param string $path
     * @return HttpClient
     */
    public function setSslCert($path)
    {
        $this->sslCert = $path;

        return $this;
    }

    /**
     * @param $username
     * @param $password
     * @return HttpClient
     */
    public function setBasicAuth($username, $password)
    {
        $this->basicAuth = $username . ':' . $password;

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

        if (!is_null($this->sslKey)) {
            curl_setopt($curl, CURLOPT_SSLKEY, $this->sslKey);
        }

        if (!is_null($this->sslCert)) {
            curl_setopt($curl, CURLOPT_SSLCERT, $this->sslCert);
        }

        if (!is_null($this->basicAuth)) {
            curl_setopt($curl, CURLOPT_USERPWD, $this->basicAuth);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        $body = curl_exec($curl);
        $info = curl_getinfo($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $this->response = new HttpClientResponse($info, $body, $error);

        if ($this->response->hasError()){
            throw new ErrorResponseException(new Response($this->response->getError(), $this->response->getHttpCode(), $this->response->getBody()));
        }

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