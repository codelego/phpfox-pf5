<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 5/6/17
 * Time: 8:49 PM
 */

namespace Phpfox\RapidDev;


class TableInfoTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @return TableInfo
     */
    public function testBase()
    {
        $tableInfo = new TableInfo('i18n_language');

        return $tableInfo;
    }


    public function testConvert()
    {
        $formGenerate = new FormAdminAddGenerator([
            'tableName'  => 'i18n_language',
            'packageId'  => 'core',
            'formType'   => 'Add',
            'textDomain' => 'admin',
        ]);

        $result = $formGenerate->process();

        $this->assertNotEmpty($result);
    }


}
