<?php

namespace Phpfox\Db;

use PHPUnit_Framework_TestCase;

class SqlConditionTest extends PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {

        $db = \Phpfox::get('db');
        $sql = (new SqlSelect($db))->select('*')->from(':setting_value')
            ->where('is_active=?', 1);

        $this->assertNotEmpty($sql->prepare());

    }
}

