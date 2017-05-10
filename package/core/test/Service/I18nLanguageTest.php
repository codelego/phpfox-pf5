<?php

namespace Neutron\Core\Service;


class I18nLanguageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nManager();
        $data = $obj->getLocaleIdOptions();
        $this->assertNotEmpty($data);

        $this->assertContains([
            'value' => 'en',
            'label' => 'English',
        ], $data);
    }
}
