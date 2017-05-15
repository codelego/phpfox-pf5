<?php

namespace Phpfox\I18n;


class PluralRule
{
    /**
     * There are 3 case in english
     * 1: singular
     * >1: plural
     * ==0: default is plural, but optional text should be allow here.
     * there are {number} photo in this album.
     * 1: There is 1 photo in this album
     * 2: There are 2 photos in this album
     * 0: There are no photo in this album
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