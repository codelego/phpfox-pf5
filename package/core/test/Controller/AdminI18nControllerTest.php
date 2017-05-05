<?php

namespace Neutron\Core\Controller;


class AdminI18nControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AdminI18nPhraseController();

        $this->assertInstanceOf('\Phpfox\View\ViewModel', $obj->actionIndex());
        $this->assertNull($obj->actionManageLanguages());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionManagePhrases());
        $this->assertInstanceOf('\Phpfox\View\ViewModel',
            $obj->actionAdd());
    }
}
