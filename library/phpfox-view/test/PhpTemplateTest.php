<?php

namespace Phpfox\View;


class PhpTemplateTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $tpl = new PhpTemplate();

        $tpl->preferThemes(['galaxy']);

        $this->assertEmpty(get_object_vars($tpl));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testBase2()
    {
        $tpl = new PhpTemplate();

        $tpl->render('no-page', []);
    }


}
