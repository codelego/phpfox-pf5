<?php

namespace Neutron\Core\Service;


class I18nLanguageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Languages();
        $data = $obj->getLanguageIdOptions();
        $this->assertNotEmpty($data);

        $this->assertContains([
            'value' => 'en',
            'label' => 'English',
        ], $data);
    }
}
