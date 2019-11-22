<?php

namespace Juuin\HttpClient\Tests;

use Juuin\HttpClient\HttpClientServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            HttpClientServiceProvider::class
        ];
    }
}