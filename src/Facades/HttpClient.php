<?php

use Illuminate\Support\Facades\Facade;

class HttpClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'httpclient';
    }
}