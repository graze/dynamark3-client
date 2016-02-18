# dynamark3-client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/graze/dynamark3-client.svg?style=flat-square)](https://packagist.org/packages/graze/dynamark3-client)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/graze/dynamark3-client/master.svg?style=flat-square)](https://travis-ci.org/graze/dynamark3-client)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/graze/dynamark3-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/graze/dynamark3-client/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/graze/dynamark3-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/graze/dynamark3-client)
[![Total Downloads](https://img.shields.io/packagist/dt/graze/dynamark3-client.svg?style=flat-square)](https://packagist.org/packages/graze/dynamark3-client)

A Dynamark Communication Protocol 3 client, written in PHP

## Install

Via Composer

``` bash
$ composer require graze/dynamark3-client
```

## Usage

### Instantiating a client

Use the `build` method to return a `Dynamark3ClientInterface` instance with connection a to `$dsn`:

``` php
$dsn = '127.0.0.1:20000';
$client = Graze\Dynamark3Client\Dynamark3Client::build($dsn);
...
```

### Issuing commands

Commands are then simply method names that can be called directly on the client:

```php
...
// issue a GETXML command
$resp = $client->getxml();
...
```

Commands containing spaces are represented using [camelCase](https://en.wikipedia.org/wiki/CamelCase):

```php
...
// issue a MARK STOP command
$resp = $client->markStop();
...
```

Command arguments are passed as method paramaters:

```php
...
// issue a DELETEFILE command
$path = '\hard disk\domino\filecoding\codes.txt';
$resp = $client->deletefile($path);
...

```

### Responses

The client will respond with a `Dynamark3ResponseInterface` object with the following methods:
```php
/**
 * Any response from the server up until a prompt is encountered.
 *
 * @return string
 */
public function getResponseText();

/**
 * Whether an error prompt was encountered.
 *
 * @return bool
 */
public function isError();

/**
 * The error code returned from the Dynamark 3 server
 *
 * @return int
 */
public function getErrorCode();
```

Handling a response:

```php
...
$resp = $client->getxml();
if ($resp->isError()) {
    echo sprintf('the server responded with error code: [%d]', $resp->getErrorCode());
    // look up the error code in the Dynamark 3 protocol docs
    return;
}

$xml = $resp->getResponseText();
// do something fun with the xml
```

Example success response:

<img width="510" alt="screen shot 2016-02-17 at 16 38 35" src="https://cloud.githubusercontent.com/assets/1314694/13116875/8d932774-d595-11e5-8f48-51198eb9e8ba.png">

Example error response:

<img width="512" alt="screen shot 2016-02-17 at 16 39 31" src="https://cloud.githubusercontent.com/assets/1314694/13116912/b3aa9424-d595-11e5-975e-d59728c32205.png">

Some commands will return interesting data in their response, e.g. `getxml`:

<img width="842" alt="screen shot 2016-02-17 at 16 34 26" src="https://cloud.githubusercontent.com/assets/1314694/13116923/c287ab80-d595-11e5-84cd-404de2b0a598.png">

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ make test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email john@graze.com instead of using the issue tracker.

## Credits

- [John Smith](https://github.com/john-n-smith)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
