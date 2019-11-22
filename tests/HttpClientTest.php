<?php

namespace Juuin\HttpClient\Tests;

use Juuin\HttpClient\Facades\HttpClient;

/**
 * References
 * Using https://reqres.in apis
 */
class HttpClientTest extends TestCase
{
    protected $url = 'https://reqres.in';

    public function test_list_users()
    {
        $response = HttpClient::setUrl($this->url . '/api/users?page=2')
            ->send()
            ->response()
            ->toArray();

        $this->assertArrayHasKey('page', $response);
    }
}