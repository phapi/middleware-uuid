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

        $request = \Mockery::mock('Psr\Http\Message\ServerRequestInterface');
        $request->shouldReceive('withAttribute')->withArgs(['uuid', \Mockery::type('string') OR \Mockery::not('') OR \Mockery::not(null)]);

        $response = \Mockery::mock('Psr\Http\Message\ResponseInterface');
        $response->shouldReceive('withHeader')->withArgs(['uuid', \Mockery::type('string') OR \Mockery::not('') OR \Mockery::not(null)]);

        $response = $middleware(
            $request,
            $response,
            function ($request, $response) {
                return $response;
            }
        );
    }

    public function testValid() {
        $middleware = new Uuid();
        $this->assertTrue($middleware->isValid($middleware->uuid4()));
    }

    public function testValidFail()
    {
        $middleware = new Uuid();
        $this->assertFalse($middleware->isValid('65b2da62-1640-4a11-a-2c8e87afafe9'));
    }
}
