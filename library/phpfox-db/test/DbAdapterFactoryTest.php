<?php

namespace Phpfox\Db;


class DbAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    function testBase()
    {

        \Phpfox::configs()->set('db.adapters', [
            'default' => [
                'user'     => 'root',
                'password' => 'namnv123',
                'host'     => '127.0.0.1',
                'database' => 'phpfox_v5',
                'driver'   => 'mysqli',
            ],
            'example' => [
                'user'     => 'root',
                'password' => 'namnv123',
                'host'     => '127.0.0.1',
                'database' => 'phpfox_v5',
                'driver'   => 'mysqli',
            ],
        ]);


        $db = (new DbAdapterFactory)->factory(null, 'example');

        $this->assertTrue($db instanceof DbAdapterInterface);

        $db = (new DbAdapterFactory)->factory(null, null);
        $this->assertTrue($db instanceof DbAdapterInterface);
    }
}
