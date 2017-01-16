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
        $compiler = new StylesheetCompiler();
        $output =  PHPFOX_DIR .'/static/theme-test/css/main.css';
        $result = $compiler->rebuildMain($output);
        $this->assertTrue($result);

        unlink($output);
    }
}
