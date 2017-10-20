<?php

namespace Phpfox\Validate;


class NullValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new NullValidate();

        $this->assertTrue($obj->isValid(null));
        $this->assertTrue($obj->isValid(''));
        $this->assertTrue($obj->isValid(true));
        $this->assertTrue($obj->isValid(false));
        $this->assertTrue($obj->isValid([]));
    }
}
