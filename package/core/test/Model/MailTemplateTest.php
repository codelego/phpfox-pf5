<?php

namespace Neutron\Core\Model;

class MailTemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MailTemplate();

        $this->assertSame('mail_template', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getLanguageId());
        $this->assertSame('', $obj->getCode());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getVars());
    }

    public function testParameters()
    {
        $obj = new MailTemplate();

        // set data
        $obj->setId('');
        $obj->setLanguageId('');
        $obj->setCode('');
        $obj->setPackageId('');
        $obj->setVars('');
        // assert same data
        $this->assertSame('mail_template', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getLanguageId());
        $this->assertSame('', $obj->getCode());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getVars());
    }

    public function testSave()
    {
        $obj = new MailTemplate();

        $obj->save();

        /** @var MailTemplate $obj */
        $obj = _model('mail_template')
            ->select()->where('id=?', '')->first();

        $this->assertSame('mail_template', $obj->getModelId());
        $this->assertSame('', $obj->getId());
        $this->assertSame('', $obj->getLanguageId());
        $this->assertSame('', $obj->getCode());
        $this->assertSame('', $obj->getPackageId());
        $this->assertSame('', $obj->getVars());
    }

    public static function setUpBeforeClass()
    {
        _model('mail_template')
            ->delete()->where('id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('mail_template')
            ->delete()->where('id=?', '')->execute();
    }
}