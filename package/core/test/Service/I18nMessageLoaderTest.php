<?php

namespace Neutron\Core\Service;


class I18nMessageLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nMessageLoader();

        $data = $obj->load('', '');
        $this->assertArrayHasKey('Yes', $data);
        $this->assertArrayHasKey('No', $data);

        $data = $obj->load('', 'admin');

        $this->assertArrayHasKey('[storage quota note]', $data);
        $this->assertArrayHasKey('[allow blocking note]', $data);
    }

}
