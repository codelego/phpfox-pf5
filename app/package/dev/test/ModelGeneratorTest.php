<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/11/17
 * Time: 10:02 PM
 */

namespace Neutron\Dev;


class ModelGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $meta = \Phpfox::model('dev_action')->findById(450);

        $generator = new ModelGenerator($meta, []);

        $generator->process();
    }
}
