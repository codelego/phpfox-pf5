<?php
namespace Phpfox\I18n;


class PluralRule
{
    /**
     * There are 3 case
     *
     * @param int $number
     *
     * @return int
     */
    public function evaluate($number)
    {
        return abs((int)$number) == 1 ? 0 : 1;
    }
}