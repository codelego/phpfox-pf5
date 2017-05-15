<?php

namespace Phpfox\I18n;


class NumberFormaterTest extends \PHPUnit_Framework_TestCase
{

    public function testFormat()
    {
        $ft = new NumberFormater('#,##.00');

        $this->assertSame('12,344.44', $ft->format('12344.44', null));

        $ft = new NumberFormater('#,##.0000');

        $this->assertSame('12,344.4400', $ft->format('12344.44', null));

        $ft = new NumberFormater('#,##.0000');

        $this->assertSame('12,344', $ft->format(12344, null));

        $ft = new NumberFormater('#,##.00');

        $this->assertSame('12,344.44', $ft->format('12344.44', null));

        $ft = new NumberFormater('#,##.0000');

        $this->assertSame('12,344.4400', $ft->format('12344.44', null));

        $ft = new NumberFormater('#,##.0000');

        $this->assertSame('12,344', $ft->format(12344, null));
    }
}
