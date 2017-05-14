<?php

namespace Neutron\Dev\Service;


class CodeGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function testSitSettingGroups()
    {
        $result  = _get('dev.code_generator')
            ->getSiteSettingForm();

        _dump($result);
    }
}
