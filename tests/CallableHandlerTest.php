<?php

/*
 * This file is part of the callable handler package
 *
 * Copyright (c) 2017 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * See also:
 *   https://github.com/tuupola/callable-handler
 */

namespace Tuupola\Middleware;

use PHPUnit\Framework\TestCase;
use Tuupola\Http\Factory\ResponseFactory;
use Tuupola\Http\Factory\ServerRequestFactory;

class CallableHandlerTest extends TestCase
{
    public function testShouldBeTrue()
    {
        $this->assertTrue(true);
    }

    public function testShouldCreate()
    {
        $handler = new CallableHandler(
            function () {
            },
            (new ResponseFactory)->createResponse()
        );
        $this->assertInstanceOf(CallableHandler::class, $handler);
    }

    public function testShouldHandlePsr15()
    {
        $handler = new CallableHandler(
            function ($request, $response, $next = null) {
                $response->getBody()->write("deadbeef");
                return $response;
            },
            (new ResponseFactory)->createResponse()
        );

        $request = (new ServerRequestFactory)
            ->createServerRequest("GET", "https://example.com/api");

        $response = $handler->handle($request);
        $this->assertEquals("deadbeef", $response->getBody());
    }
}
