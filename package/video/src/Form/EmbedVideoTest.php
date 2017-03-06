<?php

namespace Neutron\Video\Form;


use Phpfox\Form\BootstrapFormRender;

class EmbedVideoTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $obj = new EmbedVideo();
        $this->assertNotEmpty($obj->getElement('origin_url'));

        $this->assertNotEmpty((new BootstrapFormRender())->render($obj));
    }
}
