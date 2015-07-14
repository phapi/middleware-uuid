# UUID Middleware

[![Build status](https://img.shields.io/travis/phapi/middleware-uuid.svg?style=flat-square)](https://travis-ci.org/phapi/middleware-uuid)
[![Code Climate](https://img.shields.io/codeclimate/github/phapi/middleware-uuid.svg?style=flat-square)](https://codeclimate.com/github/phapi/middleware-uuid)
[![Test Coverage](https://img.shields.io/codeclimate/coverage/github/phapi/middleware-uuid.svg?style=flat-square)](https://codeclimate.com/github/phapi/middleware-uuid/coverage)

The Phapi UUID Middleware generates an UUID (version 4) and adds it to the request object (as an attribute) and as a header to the response object. This makes it easier to debug problems as the client can refer to an UUID when contacting the API provider for help. If the UUID is used while logging it's easier for the provider to find the important information in the logs.

## Installation
This middleware is by default included in the [Phapi Framework](https://github.com/phapi/phapi-framework) but if you need to install it it's available to install via [Packagist](https://packagist.org) and [Composer](https://getcomposer.org).

```shell
$ php composer.phar require phapi/middleware-uuid:1.*
```

## Configuration
The middleware itself does not have any configuration options.

See the [configuration documentation](http://phapi.github.io/docs/started/configuration/) for more information about how to configure the integration with the Phapi Framework.

## Usage

```php
<?php
// Get the attribute from the request
$uuid = $request->getAttribute('uuid', null);

// Get header from response
$uuid = $response->getHeaderLine('uuid');

```

## Phapi
This middleware is a Phapi package used by the [Phapi Framework](https://github.com/phapi/phapi-framework). The middleware are also [PSR-7](https://github.com/php-fig/http-message) compliant and implements the [Phapi Middleware Contract](https://github.com/phapi/contract).

## License
Serializer JSON is licensed under the MIT License - see the [license.md](https://github.com/phapi/middleware-uuid/blob/master/license.md) file for details

## Contribute
Contribution, bug fixes etc are [always welcome](https://github.com/phapi/middleware-uuid/issues/new).
