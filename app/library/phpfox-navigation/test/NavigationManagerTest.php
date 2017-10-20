<?php

namespace Phpfox\Navigation;


class NavigationManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBase()
    {
        $mn = new NavigationManager();

        $mn->render('empty', null);
    }


    public function testBase2()
    {
        $mn = new NavigationManager();

        $result = $mn->render('navbar', 'admin', null, [], 1, []);

        $this->assertNotEmpty($result, $result);
    }

    public function testBase3()
    {
        $mn = new NavigationManager();

        $result = $mn->render('nav', 'admin', null, [], 1, []);

        $this->assertNotEmpty($result);
    }

    public function testBase4()
    {
        $mn = new NavigationManager();

        $this->assertEmpty($mn->render('nav', 'empty', null, [], 1, []));
        $this->assertEmpty($mn->render('navbar', 'empty', null, [], 1, []));
    }
}
