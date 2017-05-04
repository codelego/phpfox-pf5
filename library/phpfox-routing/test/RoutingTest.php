<?php

namespace Phpfox\Routing;

class RoutingTest extends \PHPUnit_Framework_TestCase
{
    public function _testCreate()
    {
        $admin = new Routing('admin', null);

        $admin->add(new Routing('admin.language', null));
        $admin->add(new Routing('admin.language.edit', null));
        $admin->add(new Routing('admin.language.listing', null));
        $admin->add(new Routing('admin.store', null));
        $admin->add(new Routing('admin.store.product', null));
        $admin->add(new Routing('admin.store.product.listing', null));
    }

    public function testRouteAdmin()
    {
        $admin = new Routing('admin', new Route([
            'route'    => 'admincp/*',
            'defaults' => [
                'controller' => 'core.admin.index',
                'action'     => 'dashboard',
            ],
        ]));

        $parameters = new Parameters();

        $this->assertTrue($admin->match('admincp/core/dashboard', null,
            $parameters));

        $this->assertEquals('core.admin.index', $parameters->get('controller'));
        $this->assertEquals('dashboard', $parameters->get('action'));

        $this->assertEquals('admincp', $admin->compile(null, null));
        $this->assertEquals('admincp', $admin->compile('admin', null));
    }

    public function testAdminUser()
    {
        $admin = new Routing('admin', new Route([
            'route'    => 'admincp/*',
            'defaults' => [
                'controller' => 'core.admin.index',
                'action'     => 'dashboard',
            ],
        ]));

        $admin->add(new Routing('admin.user', new Route([
            'route'    => 'user/*',
            'defaults' => [
                'controller' => 'user.admin.manage',
                'action'     => 'index',
            ],
        ])));

        $parameters = new Parameters();

        $this->assertTrue($admin->match('admincp/core/dashboard', null,
            $parameters));

        $this->assertEquals('core.admin.index', $parameters->get('controller'));
        $this->assertEquals('dashboard', $parameters->get('action'));

        $this->assertTrue($admin->match('admincp/user', null, $parameters));

        $this->assertEquals('user.admin.manage',
            $parameters->get('controller'));
        $this->assertEquals('index', $parameters->get('action'));

        $this->assertEquals('admincp', $admin->compile(null, null));
        $this->assertEquals('admincp/user', $admin->compile('admin.user', null));
    }

    public function testAdminUserDelete()
    {
        $admin = new Routing('admin', new Route([
            'route'    => 'admincp/*',
            'defaults' => [
                'controller' => 'core.admin.index',
                'action'     => 'dashboard',
            ],
        ]));

        $admin->add(new Routing('admin.user', new Route([
            'route'    => 'user/*',
            'defaults' => [
                'controller' => 'user.admin.manage',
                'action'     => 'index',
            ],
        ])));

        $admin->add(new Routing('admin.user.delete', new Route([
            'route'    => 'delete/<id>',
            'defaults' => [
                'action' => 'delete',
            ],
        ])));

        $parameters = new Parameters();

        $this->assertTrue($admin->match('admincp/core/dashboard', null,
            $parameters));

        $this->assertEquals('core.admin.index', $parameters->get('controller'));
        $this->assertEquals('dashboard', $parameters->get('action'));

        $this->assertTrue($admin->match('admincp/user', null, $parameters));

        $this->assertEquals('user.admin.manage',
            $parameters->get('controller'));
        $this->assertEquals('index', $parameters->get('action'));

        $this->assertTrue($admin->match('admincp/user/delete/2', null,
            $parameters));

        $this->assertEquals('user.admin.manage',
            $parameters->get('controller'));
        $this->assertEquals('delete', $parameters->get('action'));

        $this->assertEquals('admincp', $admin->compile(null, null));
        $this->assertEquals('admincp/user', $admin->compile('admin.user', null));
        $this->assertEquals('admincp/user/delete/1',
            $admin->compile('admin.user.delete', ['id' => 1]));
    }

    public function testProfile()
    {
        $profile = new Routing('profile', null);

        $profile->add(new Routing('profile.blogs', new Route([
            'route' => 'blogs',
        ])));

        $profile->chain(new Route([
            'route'    => 'profile/<name>/*',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'home',
            ],
        ]));

        $parameters = new Parameters();

        $this->assertTrue($profile->match('profile/namnv', null, $parameters));

        $this->assertEquals('namnv', $parameters->get('name'));
        $this->assertEquals('user.profile', $parameters->get('controller'));
        $this->assertEquals('home', $parameters->get('action'));

        // where to chain the access
    }

    public function testProfileWithFilter()
    {
        $profile = new Routing('profile', null);

        $profile->add(new Routing('profile.blogs', new Route([
            'route' => 'blogs',
        ])));


        $profile->chain(new Route([
            'route'    => 'profile/<name>/*',
            'filter'   => 'user.profile_filter',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'home',
            ],
        ]));

        $parameters = new Parameters();

        $this->assertTrue($profile->match('profile/namnv', null, $parameters));

        $this->assertEquals('namnv', $parameters->get('name'));
        $this->assertEquals('user.profile', $parameters->get('controller'));
        $this->assertEquals('home', $parameters->get('action'));
        // where to chain the access

        $this->assertFalse($profile->match('profile/apache', null,
            $parameters));
        $this->assertFalse($profile->match('namnv', null, $parameters));


        $this->assertEquals('profile/namnv',
            $profile->compile('profile', ['name' => 'namnv']));
    }

    public function testProfileWithBlog()
    {
        $profile = new Routing('profile', null);

        $profile->add(new Routing('profile.blogs', new Route([
            'route' => 'blogs',
        ])));


        $profile->chain(new Route([
            'route'    => 'profile/<name>/*',
            'filter'   => 'user.profile_filter',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'home',
            ],
        ]));

        $profile->add(new Routing('profile.blogs', new Route([
            'route'    => 'blogs',
            'defaults' => [
                'controller' => 'blog.profile',
                'action'     => 'browse',
            ],
        ])));

        $parameters = new Parameters();
//
        $this->assertTrue($profile->match('profile/namnv', null, $parameters));

        $this->assertEquals('namnv', $parameters->get('name'));
        $this->assertEquals('user.profile', $parameters->get('controller'));
        $this->assertEquals('home', $parameters->get('action'));
        // where to chain the access

        $this->assertFalse($profile->match('profile/apache', null,
            $parameters));
        $this->assertFalse($profile->match('namnv', null, $parameters));

        $this->assertTrue($profile->match('profile/namnv/blogs', null,
            $parameters));


        $this->assertEquals('blog.profile', $parameters->get('controller'));
        $this->assertEquals('browse', $parameters->get('action'));

        $this->assertEquals('profile/namnv/blogs',
            $profile->compile('profile.blogs',
                ['name' => 'namnv']));
    }
}
