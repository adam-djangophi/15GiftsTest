<?php

namespace Tests\Unit;

use App\Helpers\NumberHelper;
use Tests\TestCase;

class NumberHelperTest extends TestCase
{
    public function testStripCommasFromNumeric(): void
    {
        $this->assertEquals("12345.45", NumberHelper::stripCommasFromNumeric("12,345.45"));
        $this->assertEquals("12345", NumberHelper::stripCommasFromNumeric("12,345"));
    }

    public function testStripCommasFromNumericInt(): void
    {
        $this->assertEquals("12345", NumberHelper::stripCommasFromNumericInt("12,345.45"));
        $this->assertEquals("12345", NumberHelper::stripCommasFromNumericInt("12,345"));
    }
}
