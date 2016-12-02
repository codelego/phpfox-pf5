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
        return $number == 0 ? 0 : ($number == 1 ? 1 : 2);
    }
}