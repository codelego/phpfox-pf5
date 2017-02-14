<?php

namespace Neutron\Core\Controller;


class AdminI18nControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminI18nController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertNull($obj->actionLanguages());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionPhrases());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionAddPhrase());
    }
}
