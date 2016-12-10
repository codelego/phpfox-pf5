<?php

namespace Phpfox\Assets;


class HtmlHeaderTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $htmlFacades = \Phpfox::get('html');

        $this->assertInstanceOf('Phpfox\Html\HtmlFacades', $htmlFacades);

        if ($htmlFacades instanceof HtmlFacades) {
            ;
        }

        $htmlFacades->setTitle('test');
    }
}
