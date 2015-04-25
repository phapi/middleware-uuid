<?php

namespace Phapi\Middleware\Uuid;

use Phapi\Contract\Middleware\Middleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * UUID Middleware
 *
 * Generates an UUID (version 4) and adds it to the request
 * object (as an attribute) and as a header to the response object.
 *
 * @category Phapi
 * @package  Phapi\Middleware\Uuid
 * @author   Peter Ahinko <peter@ahinko.se>
 * @license  MIT (http://opensource.org/licenses/MIT)
 * @link     https://github.com/phapi/middleware-uuid
 */
class Uuid implements Middleware
{

    /**
     * Execute middleware
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        // Generate uuid
        $uuid = $this->uuid4();

        // Update request
        $request = $request->withAttribute('uuid', $uuid);

        // Update response
        $response = $response->withHeader('uuid', $uuid);

        return $next($request, $response, $next);
    }

    /**
     *
     * Generate v4 UUID
     *
     * Version 4 UUIDs are pseudo-random.
     *
     * @return  string
     */
    public static function uuid4()
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $data = openssl_random_pseudo_bytes(16);
        } else {
            $data = file_get_contents('/dev/urandom', null, null, 0, 16);
        }

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Validate UUID
     *
     * @param $uuid
     * @return bool
     */
    public static function isValid($uuid)
    {
        return preg_match(
            '/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
            '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i',
            $uuid
        ) === 1;
    }
}
