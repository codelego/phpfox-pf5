<?php

namespace Neutron\Core\Service;


use Phpfox\Layout\LayoutPage;

class LayoutLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutLoader();

        $this->assertSame(['blog_index_index', 'default'],
            $obj->findAcceptablePageId('blog_index_index'));

        $this->assertSame(['blog_index_my', 'default'],
            $obj->findAcceptablePageId('blog_index_my'));
    }

    public function testAcceptThemes()
    {
        $obj = new LayoutLoader();

        $this->assertSame(['default'], $obj->findAcceptableThemeId('default'));
        $this->assertSame(['admin', 'default'],
            $obj->findAcceptableThemeId('admin'));
        $this->assertSame(['galaxy', 'default'],
            $obj->findAcceptableThemeId('galaxy'));
    }

    public function testLoadForRender()
    {
        $obj = new LayoutLoader();

        $result = $obj->loadForRender('default', 'default');

        $this->assertTrue($result instanceof LayoutPage);

        return $result;
    }

    /**
     * @param LayoutPage $layoutPage
     * @depends testLoadForRender
     */
    public function testLayoutPageRender(LayoutPage $layoutPage)
    {
        $this->assertNotEmpty($layoutPage->render());

        echo $layoutPage->render();
    }

}
