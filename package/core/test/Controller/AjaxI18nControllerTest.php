<?php

namespace Neutron\Core\Controller;


class AjaxI18nControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AjaxI18nController();

        $this->assertInstanceOf('Phpfox\View\ViewModel', $obj->actionSave());
    }
}
