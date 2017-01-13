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

        $compiler =  new StylesheetCompiler();

        $result  =  $compiler->rebuild('default');

        $this->assertTrue($result);
    }
}
