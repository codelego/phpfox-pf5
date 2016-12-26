<?php

namespace Phpfox\Action;

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


        $this->assertEquals('result-of-abc', $controller->run('abc'));
        $this->assertEquals('result-of-action-with-long-name',
            $controller->run('with-long-name'));

        $controller->{'sampleMethod'}();

    }

    function testForward()
    {
        $controller = new ExampleActionController();

        $result = $controller->run('no-action-name');
        
        $this->assertFalse($result);
    }

}
