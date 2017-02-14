<?php

namespace Neutron\Core\Model;


class I18nMessageTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new I18nMessage([
            'id'         => 8,
            'locale'     => '',
            'domain'     => '',
            'var_name'   => 'No',
            'text_value' => '[No]',
            'is_json'    => '0',
            'is_updated' => '0',
        ]);

        $this->assertEquals(8, $obj->getId());
        $this->assertEquals('i18n_message', $obj->getModelId());
        $this->assertEquals('', $obj->getLocale());
        $this->assertEquals('', $obj->getDomain());
        $this->assertEquals('No', $obj->getName());
        $this->assertEquals('[No]', $obj->getTextValue());
        $this->assertEquals('0', $obj->isJson());
        $this->assertEquals('0', $obj->isUpdated());

    }

    public function testSave()
    {
        $obj = new I18nMessage([
            'id'         => 8,
            'locale'     => '',
            'domain'     => '',
            'var_name'   => 'No',
            'text_value' => '[No]',
            'is_json'    => '0',
            'is_updated' => '0',
        ]);

        $obj->setDomain('domain 1');
        $obj->setLocale('locale 1');
        $obj->setName('No 1');
        $obj->setTextValue('[No 1]');
        $obj->setTextValue('[No 1]');
        $obj->setJson('1');
        $obj->setUpdated('1');

        $this->assertEquals(8, $obj->getId());
        $this->assertEquals('i18n_message', $obj->getModelId());
        $this->assertEquals('locale 1', $obj->getLocale());
        $this->assertEquals('domain 1', $obj->getDomain());
        $this->assertEquals('No 1', $obj->getName());
        $this->assertEquals('[No 1]', $obj->getTextValue());
        $this->assertEquals('1', $obj->isJson());
        $this->assertEquals('1', $obj->isUpdated());
    }
}
