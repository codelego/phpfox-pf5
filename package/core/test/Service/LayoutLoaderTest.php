<?php

namespace Neutron\Core\Service;


use Phpfox\Layout\Page;

class LayoutLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Loader();

        $this->assertSame(['blog_index_index', 'default'],
            $obj->findAcceptableActionId('blog_index_index'));

        $this->assertSame(['blog_index_my', 'default'],
            $obj->findAcceptableActionId('blog_index_my'));
    }

    public function testAcceptThemes()
    {
        $obj = new Loader();

        $this->assertSame(['default'], $obj->findAcceptableThemeId('default'));
        $this->assertSame(['admin', 'default'],
            $obj->findAcceptableThemeId('admin'));
        $this->assertSame(['galaxy', 'default'],
            $obj->findAcceptableThemeId('galaxy'));
    }

    public function testLoadForRender()
    {
        $obj = new Loader();

        $result = $obj->loadForRender('default', 'default');

        $this->assertTrue($result instanceof Page);

        return $result;
    }

    /**
     * @param Page $layoutPage
     *
     * @depends testLoadForRender
     */
    public function testLayoutPageRender(Page $layoutPage)
    {
        $this->assertNotEmpty($layoutPage->render());

        echo $layoutPage->render();
    }

}
