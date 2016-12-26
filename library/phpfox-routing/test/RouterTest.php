<?php

namespace Phpfox\Routing;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $router = new Router();

        $router->initialize();

        $this->assertNotEmpty($router);
    }

    public function testRunAdmin()
    {
        $router = new Router();

        $router->initialize();

        $parameters = $router->run('admincp');

        $this->assertEquals('core.admin.index', $parameters->get('controller'));

        $this->assertEquals('dashboard', $parameters->get('action'));

        $this->assertEquals('admincp', $router->getUri('admin', []));

        $parameters = $router->run('admincp/core/i18n');

        $this->assertEquals('core.admin.i18n', $parameters->get('controller'));
        $this->assertEquals('index', $parameters->get('action'));

        $this->assertEquals('admincp/core/i18n',
            $router->getUri('admin.core.i18n', []));

        $parameters = $router->run('admincp/core/i18n/languages');

        $this->assertEquals('core.admin.i18n', $parameters->get('controller'));
        $this->assertEquals('languages', $parameters->get('action'));

        $this->assertEquals('admincp/core/i18n/languages',
            $router->getUri('admin.core.i18n.languages', []));
    }
}
