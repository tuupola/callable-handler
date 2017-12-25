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

class CallableHandlerTest extends TestCase
{
    public function testShouldBeTrue()
    {
        $this->assertTrue(true);
    }
}
