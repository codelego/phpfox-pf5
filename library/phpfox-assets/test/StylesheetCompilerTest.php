<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 1/13/17
 * Time: 11:28 AM
 */

namespace Phpfox\Assets;


class StylesheetCompilerTest extends \PHPUnit_Framework_TestCase
{
    public function testBundle()
    {
        $obj = new StylesheetCompiler();

        $array = explode(PHP_EOL, $obj->getInitial());
        $this->assertEquals([
            '@import "user-variables";',
            '@import "variables";',
            '@import "config-variables";',
            '@import "bootstrap/mixins";',
            '@import "mixins";',
        ], $array);
    }

    public function testSimpleCompile()
    {
        $obj = new StylesheetCompiler();
        $content = $obj->compile('body{color: $red}', ['red' => '#f00'], []);
        $this->assertEquals('body{color:#f00}', $content);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Undefined variable $red
     */
    public function testSimpleCompileMissingVariables()
    {
        $obj = new StylesheetCompiler();
        $content = $obj->compile('body{color: $red}', [], []);
        $this->assertEquals('body{color:#f00}', $content);
    }

    public function testRebuild()
    {
        $obj = new StylesheetCompiler();
        $output = PHPFOX_DATA_DIR . '/cache/test-rebuild.css';

        if (isset($output)) {
            @unlink($output);
        }
        $source = file_get_contents(__DIR__ . '/../assets/test.scss');

        $result = $obj->rebuild($source, $output, ['red' => '#f00'],
            [__DIR__ . '/../assets/test.scss']);

        $this->assertTrue($result);

        @unlink($output);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Undefined variable $red
     */
    public function testRebuildFailure()
    {
        $obj = new StylesheetCompiler();
        $output = PHPFOX_DATA_DIR . '/cache/test-rebuild.css';

        if (isset($output)) {
            @unlink($output);
        }
        $source = file_get_contents(__DIR__ . '/../assets/test.scss');

        $result = $obj->rebuild($source, $output, [],
            [__DIR__ . '/../assets/test.scss']);

        $this->assertTrue($result);

        @unlink($output);
    }
}
