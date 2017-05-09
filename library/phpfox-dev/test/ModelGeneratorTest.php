<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/7/17
 * Time: 9:53 AM
 */

namespace Phpfox\RapidDev;


class ModelGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $modelGenerator = new ModelGenerator([
            'tableName'=>'i18n_language',
            'packageId'=> 'core',
        ]);

        $modelGenerator->process();
    }
}
