<?php

/*

Copyright (c) 2017-2018 Mika Tuupola

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/

/**
 * @see       https://github.com/tuupola/callable-handler
 * @license   http://www.opensource.org/licenses/mit-license.php
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
