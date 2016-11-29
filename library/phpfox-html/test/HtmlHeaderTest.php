<?php

namespace Phpfox\Html;


class HtmlHeaderTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $htmlFacades = service('html');

        $this->assertInstanceOf('Phpfox\Html\HtmlFacades', $htmlFacades);

        if ($htmlFacades instanceof HtmlFacades) {
            ;
        }

        $htmlFacades->setTitle('test');
    }
}
