<?php

namespace Phpfox\Kernel;

class ExampleActionController extends ActionController
{

    function actionAbc()
    {
        return 'result-of-abc';
    }

    function actionWithLongName()
    {
        return 'result-of-action-with-long-name';
    }
}

class ActionControllerTest extends \PHPUnit_Framework_TestCase
{

    function testBase()
    {
        $controller = new ExampleActionController();


        $this->assertEquals('result-of-abc', $controller->dispatch('abc'));
        $this->assertEquals('result-of-action-with-long-name',
            $controller->dispatch('with-long-name'));


    }

    function testForward()
    {
        $controller = new ExampleActionController();

        $result = $controller->dispatch('no-action-name');

        $this->assertFalse($result);
    }

}
