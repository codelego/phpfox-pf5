<?php

namespace Phpfox\Assets;


class RequireJsTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $obj = new RequireJs();

        $configs = json_decode(str_replace('requirejs.config(', '',
            trim($obj->renderConfig(), ');')), true);

        $this->assertEquals('dist/primary.bundle',
            $obj->getPrimaryBundleName());

        $this->assertArrayHasKey('paths', $configs);
        $this->assertArrayHasKey('baseUrl', $configs);
        $this->assertArrayHasKey('bundles', $configs);
        $this->assertArrayHasKey('shim', $configs);
        $this->assertArrayHasKey('waitSeconds', $configs);
    }

    public function testBase2()
    {
        $obj = new RequireJs();

        $obj->modules('core', 'static/jscript/core');

        $this->assertArrayHasKey('core', $obj->getModules());
        $this->assertContains([
            'name' => 'core',
            'path' => 'static/jscript/core',
        ], $obj->getModules());

    }

    public function testBase3()
    {
        $obj = new RequireJs();

        $obj->modules('neutron-core', 'static/jscript/core', 'core');

        $this->assertArrayHasKey('neutron-core', $obj->getModules());
        $this->assertContains([
            'name' => 'core',
            'path' => 'static/jscript/core',
        ], $obj->getModules());

    }

    public function testBase4()
    {
        $obj = new RequireJs();

        $this->assertEmpty($obj->getScripts());

        $obj->script(null, 'tinymce.init("textarea")');
        $obj->script(null, 'tinymce.init("textarea.editor")');


        $this->assertContains('tinymce.init("textarea")', $obj->getScripts());
        $this->assertContains('tinymce.init("textarea.editor")',
            $obj->getScripts());

    }

    public function testBase5()
    {
        $obj = new RequireJs();

        $this->assertEmpty($obj->getScripts());

        $obj->script('key1', 'tinymce.init("textarea")');
        $obj->script('key1', 'tinymce.init("textarea.editor")');


        $this->assertNotContains('tinymce.init("textarea")',
            $obj->getScripts());
        $this->assertContains('tinymce.init("textarea.editor")',
            $obj->getScripts());

    }

    public function testBase6()
    {
        $obj = new RequireJs();

        $obj->path('neutron-core.js', 'static/jscript/neutron-core.js');
        $obj->path('neutron-core.js', 'static/jscript/neutron-core.1.1.js');

        $this->assertArrayHasKey('neutron-core.js', $obj->getPaths());
        $this->assertNotContains('static/jscript/neutron-core.js',
            $obj->getPaths());
        $this->assertContains('static/jscript/neutron-core.1.1.js',
            $obj->getPaths());

    }

    public function testBase7()
    {
        $obj = new RequireJs();

        $obj->deps('jquery');
        $obj->deps('bootstrap');
        $obj->deps('neutron-core');

        $this->assertContains('jquery', $obj->getDeps());
        $this->assertContains('bootstrap', $obj->getDeps());
        $this->assertContains('neutron-core', $obj->getDeps());
        $this->assertNotContains('no-module', $obj->getDeps());

        $obj->onAssetManagerGetHeader(null);
        $obj->onAssetManagerGetFooter(null);


        $this->assertNotEmpty($obj->getHtml());
        $this->assertNotEmpty($obj->renderScript());
        $this->assertNotEmpty($obj->renderConfig());

    }
}
