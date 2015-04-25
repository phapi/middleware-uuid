<?php

namespace Phapi\Tests\Middleware\Uuid\Uuid;

use Phapi\Http\Request;
use Phapi\Http\Response;
use Phapi\Middleware\Uuid\Uuid;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @coversDefaultClass \Phapi\Middleware\Uuid\Uuid
 */
class UuidTest extends TestCase
{

    public function testConstructor()
    {
        $middleware = new Uuid();

        $request = new Request();
        $response = new Response();

        $response = $middleware(
            $request,
            $response,
            function ($request, $response) {
                $this->assertNotNull($request->getAttribute('uuid', null));
                return $response;
            }
        );
        $this->assertTrue($response->hasHeader('uuid'));
        $this->assertTrue($middleware->isValid($response->getHeaderLine('uuid')));
    }

    public function testValidFail()
    {
        $middleware = new Uuid();
        $this->assertFalse($middleware->isValid('65b2da62-1640-4a11-a-2c8e87afafe9'));
    }
}
