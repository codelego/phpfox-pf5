<?php

namespace Phpfox\I18n;


class PluralRuleTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $p = new PluralRule();

        $this->assertEquals(0, $p->evaluate(1));
        $this->assertEquals(1, $p->evaluate(2));
        $this->assertEquals(1, $p->evaluate(0));
    }
}
