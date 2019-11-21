<?php

namespace Juuin\HttpClient;

use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->bind('HttpClient', function () {
            return new HttpClient();
        });
    }
}