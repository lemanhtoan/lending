<?php

declare(strict_types=1);

namespace Achse\ShapeShiftIo\Test;

use Tester\Assert;
use Tester\AssertException;

class MyAssert
{


    /**
     * @param mixed $value
     * @throws AssertException
     */
    public static function floatAsStringPositive($value)
    {
        Assert::true(is_string($value));
        Assert::true(is_numeric($value), 'Not numeric value.');
        Assert::true($value > 0, 'Rate cannot be zero.');
    }

}
