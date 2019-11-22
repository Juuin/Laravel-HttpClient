<h1 align="center"> Laravel HttpClient </h1>

<p align="center"> Laravel HttpClient Facade in laravel</p>


## Installing

```shell
$ composer require juuin/laravel-httpclient
```

## Usage

#### Simple Request

```php
    $response = HttpClient::setUrl($this->url . '/api/users?page=2')
            ->send()
            ->response()
            ->toArray();
```

## License

MIT