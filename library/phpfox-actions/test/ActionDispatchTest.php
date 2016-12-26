<?php

namespace Phpfox\Action;


class ActionDispatchTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $dispatcher = new ActionDispatch();

        $this->assertEmpty($dispatcher->getAction());
        $this->assertEmpty($dispatcher->getController());
        $this->assertEmpty($dispatcher->getLastException());
        $this->assertEmpty($dispatcher->getFullActionName());


        $dispatcher->setAction('index');
        $this->assertEquals('index', $dispatcher->getAction());

        $dispatcher->setController('core.index');
        $this->assertEquals('core.index', $dispatcher->getController());

        $dispatcher->forward('core.error', '404');
        $this->assertEquals('404', $dispatcher->getAction());
        $this->assertEquals('core.error', $dispatcher->getController());
    }
}
