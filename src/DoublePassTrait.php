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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

trait DoublePassTrait
{
    /**
     * Execute as PSR-7 double pass middleware.
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface {
        return $this->process($request, new CallableHandler($next, $response));
    }
}
