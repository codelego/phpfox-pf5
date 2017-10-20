<?php

namespace Phpfox\Validate;


class EmailAddressValidateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new EmailAddressValidate();

        $this->assertTrue($obj->isValid('nam.ngvan@example.com'));
        $this->assertTrue($obj->isValid('nam_ngvan@example.com'));
        $this->assertTrue($obj->isValid('_nam_test-ngvan@example.com'));
        $this->assertTrue($obj->isValid('02-ngvan@example.com'));
        $this->assertFalse($obj->isValid('02-ngvan'));
        $this->assertFalse($obj->isValid('02-ngvan@example'));
        $this->assertTrue($obj->isValid('02-##@example.com'));
    }
}
