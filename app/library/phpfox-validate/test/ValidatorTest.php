<?php

namespace Phpfox\Validate;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $obj = new Validator([
            'name' => [
                'required' => ['message' => 'Name is required'],
                'string'   => ['message' => 'Name too long', 'max' => 20],
            ],
        ]);

        $this->assertFalse($obj->isValid(['name' => 'This parameter is intended exclusively for YouTube content partners.']));
        $this->assertFalse($obj->isValid(['name' => '']));

        $this->assertTrue($obj->has('name', 'required'));
        $this->assertTrue($obj->has('name', 'string'));
        $this->assertFalse($obj->has('name', 'example'));

        $this->assertTrue($obj->get('name', 'required') instanceof
            ValidateInterface);
        $this->assertTrue($obj->get('name', 'string') instanceof
            ValidateInterface);
        $this->assertNull($obj->get('name', 'example'));

        /** @var RequiredValidate $val */
        $val = $obj->get('name', 'required');

        $this->assertSame(true, $val->get('skip'));

        /** @var StringValidate $val */
        $val = $obj->get('name', 'string');

        $this->assertSame(null, $val->get('skip'));
        $this->assertSame(20, $val->get('max'));

    }

    public function testBase2()
    {
        $obj = new Validator([
            'name' => [
                'required' => [
                    'message' => 'Name is required',
                    'skip'    => false,
                ],
                'string'   => [
                    'message' => 'Name too long',
                    'min'     => 10,
                    'max'     => 20,
                ],
            ],
        ]);

        $this->assertFalse($obj->isValid(['name' => 'Note: This parameter is intended exclusively for YouTube content partners. The onBehalfOfContentOwner parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This']));
        $this->assertFalse($obj->isValid(['name' => '']));

        /** @var RequiredValidate $val */
        $val = $obj->get('name', 'required');

        $this->assertSame(false, $val->get('skip'));

    }

}
