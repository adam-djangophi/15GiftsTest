<?php

namespace App\Services;

use App\Interfaces\IntToStringInterface;

class NumberConvertor implements IntToStringInterface
{
    public function __construct(private array $words)
    {
    }

    public function convert(int $number): ?string
    {
        $wordString = implode(' ', $this->getWordsInNumber($number));
        $wordString = preg_replace('/^and /', '', $wordString) ?? '';
        $wordString = ucfirst(trim($wordString));

        return $wordString;
    }

    private function getWordsInNumber(int $number): array
    {
        $wordStore = [];

        $numberLength = strlen((string) $number);
        $thousandsSeparators = (int) (($numberLength + 2) / 3);
        $maxLength = $thousandsSeparators * 3;
        // Prefix number with 00s if needed
        $number = substr('00' . $number, -$maxLength);
        // split number into groups, e.g 1,000,000 becomes 001,000,000
        $levelGroups = str_split($number, 3);

        for ($i = 0; $i < count($levelGroups); $i++) {
            $thousandsSeparators--;
            $group = (int) $levelGroups[$i];

            $hundreds = $this->getHundreds($group);
            $tens = $this->getTens($group);
            $ones = $this->getOnes($group);

            $groupString = $this->mergeAndExplode($hundreds, $tens, $ones, $group, $thousandsSeparators);
            $wordStore[] = $groupString;
        }

        return $wordStore;
    }

    private function mergeAndExplode(
        array $hundreds,
        array $tens,
        array $ones,
        int $group,
        int $thousandsPosition
    ): string {
        $merged = array_merge(array_merge($hundreds, $tens), $ones);
        $thousands = $thousandsPosition > 0 && $group > 0 ? ' ' . $this->words['thousands'][$thousandsPosition] : '';

        return implode(' ', $merged) . $thousands;
    }

    private function getOnes(int $group): array
    {
        //divide by 100 to get remainder in tens 156 > 56
        $tens = $group % 100;

        if ($tens < 20) {
            return [];
        }

        $ones = $group % 10;
        return [$this->words['ones'][$ones]];
    }

    private function getTens(int $group): array
    {
        // tens is remainder of group / 100
        $tens = $group % 100;

        if ($tens === 0) {
            return [];
        } elseif ($tens < 20) {
            return ['and', $this->words['ones'][$tens]];
        }

        // divide by ten to get the index, e.g. 97 / 10 = 9
        $tens = (int)($tens / 10);

        return ['and', $this->words['tens'][$tens]];
    }

    private function getHundreds(int $group): array
    {
        $hundreds = (int) ($group / 100);

        if ($hundreds === 0) {
            return [];
        }

        return [$this->words['ones'][$hundreds], 'hundred'];
    }
}
