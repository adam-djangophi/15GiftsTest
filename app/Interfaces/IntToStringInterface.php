<?php

namespace App\Interfaces;

interface IntToStringInterface
{
    public function convert(int $number): ?string;
}
