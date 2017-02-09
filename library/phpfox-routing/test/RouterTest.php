<?php

namespace Phpfox\Routing;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $router = new Router();

        $this->assertNotEmpty($router);
    }

    public function testRunAdmin()
    {
        $router = new Router();

        $parameters = $router->run('admincp');

        $this->assertEquals('core.admin-index', $parameters->get('controller'));

        $this->assertEquals('index', $parameters->get('action'));

        $this->assertEquals('admincp', $router->getUri('admin', []));

        $parameters = $router->run('admincp/core/i18n');

        $this->assertEquals('core.admin-i18n', $parameters->get('controller'));
        $this->assertEquals('index', $parameters->get('action'));

        $this->assertEquals('admincp/core/i18n',
            $router->getUri('admin.core.i18n', []));

        $parameters = $router->run('admincp/core/i18n/languages');

        $this->assertEquals('core.admin-i18n', $parameters->get('controller'));
        $this->assertEquals('index', $parameters->get('action'));

        $this->assertEquals('admincp/core/i18n/languages',
            $router->getUri('admin.core.i18n.languages', []));
    }

    public function testHome()
    {
        $router = new Router();

        $params = $router->run('/');

        $this->assertEquals('index', $params->get('action'));
        $this->assertEquals('core.index', $params->get('controller'));
        $this->assertEquals('home', $params->get('info.chain'));
    }

    public function testNotFound()
    {
        $router = new Router();

        $params = $router->run('/no-thing-save-k');

        $this->assertEquals(null, $params->get('action'));
        $this->assertEquals(null, $params->get('controller'));
        $this->assertEquals(null, $params->get('info.chain'));
    }

    public function testGetUrl()
    {
        $router = new Router();

        $this->assertStringStartsWith(PHPFOX_BASE_URL, _url('home'));

        $this->assertStringStartsWith(PHPFOX_BASE_URL,
            $router->getUrl('admin.core.i18n.add-phrase'));

        $this->assertStringStartsWith(PHPFOX_BASE_URL,
            $router->getUrl('admin.core.i18n', null, ['id' => 4]));

        $this->assertStringStartsWith(PHPFOX_BASE_URL,
            $router->getUrl('admin.core.i18n', null, 'id=2'));

        $this->assertStringStartsWith(PHPFOX_BASE_URL,
            $router->getUrl(PHPFOX_BASE_URL, null, 'id=2'),
            $router->getUrl(null, 'admin/index'));
    }
}
