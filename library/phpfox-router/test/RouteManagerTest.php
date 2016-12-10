<?php

namespace Phpfox\Router;


class RouteManagerTest extends \PHPUnit_Framework_TestCase
{

    public function provideUrl()
    {
        return [
            ['namnv', 'user.profile', 'index'],
            ['namnv/members', 'user.profile', 'members'],
            ['namnv/blogs', 'blog.profile', 'browse'],
            ['pages/2', 'pages.profile', 'index'],
            ['pages/1/blog/1', 'blog.profile', 'view'],
            ['namnv/blog/1', 'blog.profile', 'view'],
            ['login', 'user.auth', 'login'],
            ['register', 'user.register', 'index'],
        ];
    }

    /**
     * @dataProvider provideUrl
     *
     * @param $url
     * @param $controller
     * @param $action
     */
    public function testRun($url, $controller, $action)
    {
        $routing = \Phpfox::get('router');
        /** @var Parameters $result */
        $result = $routing->run($url, null, null, null);

        $this->assertEquals($controller, $result->get('controller'),
            $url . PHP_EOL .
            var_export($result->all(), 1));

        $this->assertEquals($action, $result->get('action'), $url . PHP_EOL);
    }

    public function testMatchAny()
    {
        $route = new Route([
            'route' => 'profile/<name>/*',
        ]);

        $result = new Parameters();

        $url = 'profile/namnv';
        $value = $route->match($url, null, null, null, $result);
        $this->assertTrue($value, $url);
        $this->assertEquals('namnv', $result->get('name'));

        $url = 'profile/namnv/blogs/2/edit';
        $value = $route->match($url, null, null, null, $result);
        $this->assertTrue($value, $url);
        $this->assertEquals('namnv', $result->get('name'));

    }
}
