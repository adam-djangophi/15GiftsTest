<?php

namespace Tests\Unit;

use App\Services\NumberConvertor;
use Tests\TestCase;

class NumberConvertorServiceTest extends TestCase
{
    public function testConvert(): void
    {
        $convertor = new NumberConvertor($this->app['config']['services.number_convertor.number_words']);

        $tests = [
            0 => '',
            1 => 'One',
            21 => 'Twenty one',
            101 => 'One hundred and one',
            127 => 'One hundred and twenty seven',
            1001 => 'One thousand and one',
            1027 => 'One thousand and twenty seven',
            1127 => 'One thousand one hundred and twenty seven',
            10001 => 'Ten thousand and one',
            10027 => 'Ten thousand and twenty seven',
            10127 => 'Ten thousand one hundred and twenty seven',
            100027 => 'One hundred thousand and twenty seven',
            100127 => 'One hundred thousand one hundred and twenty seven',
            101127 => 'One hundred and one thousand one hundred and twenty seven',
            111127 => 'One hundred and eleven thousand one hundred and twenty seven',
            999999 => 'Nine hundred and ninety nine thousand nine hundred and ninety nine',
            1000000 => 'One million',
            1999999 => 'One million nine hundred and ninety nine thousand nine hundred and ninety nine',
        ];

        foreach ($tests as $number => $text) {
            $this->assertEquals($text, $convertor->convert($number), "int {$number} - did not match {$text}");
        }
    }
}
