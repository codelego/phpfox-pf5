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
        $this->assertEquals(['Name too long'], $obj->getErrors('name'));
        $this->assertFalse($obj->isValid(['name' => '']));
        $this->assertEquals(['Name is required'], $obj->getErrors('name'));

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

        $this->assertSame(true, $val->isSkip());
        $this->assertSame('Name is required', $val->getMessage());

        /** @var StringValidate $val */
        $val = $obj->get('name', 'string');

        $this->assertSame(false, $val->isSkip());
        $this->assertSame('Name too long', $val->getMessage());
        $this->assertSame(20, $val->getMax());

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
        $this->assertEquals(['Name too long'], $obj->getErrors('name'));
        $this->assertEquals(true, $obj->hasErrors('name'));
        $this->assertEquals(true, $obj->hasErrors());
        $this->assertFalse($obj->isValid(['name' => '']));

        /** @var RequiredValidate $val */
        $val = $obj->get('name', 'required');

        $this->assertSame(false, $val->isSkip());
        $this->assertSame('Name is required', $val->getMessage());

        $this->assertEquals(['Name is required', 'Name too long'],
            $obj->getErrors('name'));
        $this->assertTrue($obj->hasErrors('name'));
        $this->assertTrue($obj->hasErrors());
    }

    public function testErrors()
    {
        $obj = new Validator();

        $obj->addError('name', 'error message 01');

        $this->assertSame(['error message 01'], $obj->getErrors('name'));
        $this->assertSame(['name' => ['error message 01']], $obj->getErrors());

        $obj->addError('name', 'error message 02');
        $this->assertSame(['error message 01', 'error message 02'],
            $obj->getErrors('name'));

        $this->assertSame(['name' => ['error message 01', 'error message 02']],
            $obj->getErrors());


        $obj->addError('name2', 'error message 03');
        $this->assertSame(['error message 03'], $obj->getErrors('name2'));

        $this->assertSame([
            'name' => ['error message 01', 'error message 02'],
            'name2' => ['error message 03'],
        ],
            $obj->getErrors());
    }
}
