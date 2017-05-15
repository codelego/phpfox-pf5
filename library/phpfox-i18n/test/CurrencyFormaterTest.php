<?php

namespace Phpfox\I18n;


class CurrencyFormaterTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $ft = new CurrencyFormater();
        $ft->setPattern('{1} #,###.00');

        $this->assertSame('usd 1,234', $ft->format(1234, 'usd', null, null));
        $this->assertSame('vnd 1,234', $ft->format(1234, 'vnd', null, null));
    }
}
