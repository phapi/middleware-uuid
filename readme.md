# UUID Middleware
The Phapi UUID Middleware generates an UUID (version 4) and adds it to the request object (as an attribute) and as a header to the response object.

```php
<?php
// Get the attribute from the request
$uuid = $request->getAttribute('uuid', null);

// Get header from response
$uuid = $response->getHeaderLine('uuid');

```

## Phapi
This middleware is a Phapi package used by the [Phapi Framework](https://github.com/phapi/phapi). The middleware are also [PSR-7](https://github.com/php-fig/http-message) compliant and implements the [Phapi Middleware Contract](https://github.com/phapi/contract).

## License
Serializer JSON is licensed under the MIT License - see the [license.md](https://github.com/phapi/middleware-uuid/blob/master/license.md) file for details

## Contribute
Contribution, bug fixes etc are [always welcome](https://github.com/phapi/middleware-uuid/issues/new).
