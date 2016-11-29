<?php
namespace Phpfox\I18n;


class PluralRule
{
    /**
     * @param int $number
     *
     * @return int
     */
    public function evaluate($number)
    {
        return $number == 1 ? 0 : 1;
    }
}