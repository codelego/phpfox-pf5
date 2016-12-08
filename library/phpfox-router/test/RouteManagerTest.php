<?php

namespace Phpfox\Router;


class RouteManagerTest extends \PHPUnit_Framework_TestCase
{

    public function provideUrl()
    {
        return [
            ['namnv', 'core.index'],
            ['namnv/blogs', 'blog.profile'],
            ['namnv/pages', 'pages.profile'],
            ['pages/1/blogs', 'pages.profile'],
        ];
    }

    /**
     * @dataProvider provideUrl
     *
     * @param $url
     * @param $controller
     */
    public function testRun($url, $controller)
    {
        $routing = \Phpfox::get('router');
        /** @var Result $result */
        $result = $routing->run($url, null, null, null);

        $this->assertEquals($controller, $result->getController());
    }
}
