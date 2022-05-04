# Tessitura API - PHP Client

A PHP wrapper for the [Tessitura](https://www.tessituranetwork.com) REST API.

## Installation

```
composer require forumone/tessitura
```


## Setup

```php
require __DIR__ . '/vendor/autoload.php';

use ForumOne\Tessitura\Client;

$tessitura = new Client(
  'https://acmeorg0resttest.tnhs.cloud/TessituraService/',
  'user_XXXXXXXXXXXXXXXXXXXX',
  'password_XXXXXXXXXXXXXXXX',
  [
    'timeout' => 20,
  ]
);
```

## Client class

```php
$tessitura = new Client($url, $user, $password, $options);
```

### Options

| Option            | Type     | Required | Description                                |
| ----------------- | -------- | -------- | ------------------------------------------ |
| `url`             | `string` | yes      | Your TessituraService base URI             |
| `user`            | `string` | yes      | Your API user                              |
| `password`        | `string` | yes      | Your API password                          |
| `options`         | `array`  | no       | Extra arguments (see client options table) |

#### Client options

| Option                   | Type     | Required | Description                                                                                                                                            |
| ------------------------ | -------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `timeout`                | `int`    | no       | Request timeout, default is `15`                                                                                                                       |
| `verify_ssl`             | `bool`   | no       | Verify SSL when connect, use this option as `false` when need to test with self-signed certificates, default is `true`                                 |
| `follow_redirects`       | `bool`   | no       | Allow the API call to follow redirects                                                                                                                 |
| `query_string_auth`      | `bool`   | no       | Force Basic Authentication as query string when `true` and using under HTTPS, default is `false`                                                       |
| `user_agent`             | `string` | no       | Custom user-agent, default is `Tessitura API Client-PHP`                                                                                               |
| `method_override_query`  | `bool`   | no       | If true will mask all non-GET/POST methods by using POST method with added query parameter `?_method=METHOD` into URL                                  |
| `method_override_header` | `bool`   | no       | If true will mask all non-GET/POST methods (PUT/DELETE/etc.) by using POST method with added `X-HTTP-Method-Override: METHOD` HTTP header into request |

## Client methods

### GET

```php
$tessitura->get($endpoint, $parameters = []);
```

### POST

```php
$tessitura->post($endpoint, $data);
```

### PUT

```php
$tessitura->put($endpoint, $data);
```

### DELETE

```php
$tessitura->delete($endpoint, $parameters = []);
```

### OPTIONS

```php
$tessitura->options($endpoint);
```

#### Arguments

| Params       | Type     | Description                                                                           |
| ------------ | -------- | ------------------------------------------------------------------------------------- |
| `endpoint`   | `string` | TessituraService API endpoint, example: `Diagnostics/Status` or `TXN/Performances/69` |
| `data`       | `array`  | Only for POST and PUT, data that will be converted to JSON                            |
| `parameters` | `array`  | Only for GET and DELETE, request query string                                         |

#### Response

Methods will return arrays or PHP objects on success, or throw `HttpClientException` errors on failure.

```php
use ForumOne\Tessitura\HttpClient\HttpClientException;

try {

  // GET request example.
  $results = $tessitura->get('Diagnostics/Status');
  
  // OR
  
  // POST request example.
  $results = $tessitura->post(
    'TXN/Performances/Search',
    array(
      'PerformanceStartDate' => '2018-10-01T00:00:00.0Z',
      'PerformanceEndDate'   => '2018-12-03T00:00:00.0Z',
    )
  );
  
  // Print or do something with results.
  print_r('<pre>');
  print_r($results);
  print_r('</pre>');
  
} catch (HttpClientException $e) {

  print_r('<pre>');
  print_r($e->getMessage()); // Error message.
  print_r($e->getRequest()); // Last request data.
  print_r($e->getResponse()); // Last response data.
  print_r('</pre>');
  
}
```
