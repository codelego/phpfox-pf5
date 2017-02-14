<?php

namespace Neutron\Core\Model;

class MailTemplateTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new MailTemplate([
            'id'          => 1,
            'language_id' => '',
            'code'        => '[user_welcome]',
            'package_id'  => '[core]',
            'vars'        => 'abc,def, ghti',
        ]);

        $this->assertSame('mail_template', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('', $obj->getLanguageId());
        $this->assertSame('[user_welcome]', $obj->getCode());
        $this->assertSame('[core]', $obj->getPackageId());
        $this->assertSame('abc,def, ghti', $obj->getVars());
    }

    public function testParameters()
    {
        $obj = new MailTemplate();

        // set data
        $obj->setId(1);
        $obj->setLanguageId('');
        $obj->setCode('[user_welcome]');
        $obj->setPackageId('[core]');
        $obj->setVars('abc,def, ghti');

        // assert same data
        $this->assertSame('mail_template', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('', $obj->getLanguageId());
        $this->assertSame('[user_welcome]', $obj->getCode());
        $this->assertSame('[core]', $obj->getPackageId());
        $this->assertSame('abc,def, ghti', $obj->getVars());
    }

    public function testSave()
    {
        $obj = new MailTemplate([
            'id'          => 1,
            'language_id' => '',
            'code'        => '[user_welcome]',
            'package_id'  => '[core]',
            'vars'        => 'abc,def, ghti',
        ]);

        $obj->save();

        /** @var MailTemplate $obj */
        $obj = \Phpfox::with('mail_template')
            ->select()->where('id=?', 1)->first();

        $this->assertSame('mail_template', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('', $obj->getLanguageId());
        $this->assertSame('[user_welcome]', $obj->getCode());
        $this->assertSame('[core]', $obj->getPackageId());
        $this->assertSame('abc,def, ghti', $obj->getVars());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('mail_template')
            ->delete()->where('id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('mail_template')
            ->delete()->where('id=?', 1)->execute();
    }
}