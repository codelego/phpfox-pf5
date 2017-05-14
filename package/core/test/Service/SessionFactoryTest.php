<?php

namespace Neutron\Core\Service;

use Phpfox\Session\FilesSession;
use Phpfox\Session\MemcacheSession;
use Phpfox\Session\RedisSession;

class SessionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        _get('db')->delete(':session_driver')->execute();
        _get('db')->insert(':session_driver', [
            'driver_id'    => 'database',
            'driver_name'  => 'Database',
            'params'       => '[]',
            'is_default'   => 1,
            'form_name'    => '[form name]',
            'driver_class' => '[driver class]',
        ])->execute();
        _get('db')->insert(':session_driver', [
            'driver_id'    => 'files',
            'driver_name'  => 'Local File',
            'params'       => '[]',
            'is_default'   => 1,
            'form_name'    => '[form name]',
            'driver_class' => '[driver class]',
        ])->execute();
        _get('db')->insert(':session_driver', [
            'driver_id'    => 'memcache',
            'driver_name'  => 'Memcache extension',
            'params'       => '[]',
            'is_default'   => 1,
            'form_name'    => '[form name]',
            'driver_class' => '[driver class]',
        ])->execute();
        _get('db')->insert(':session_driver', [
            'driver_id'    => 'redis',
            'driver_name'  => 'Redis extension',
            'params'       => '[]',
            'is_default'   => 1,
            'form_name'    => '[form name]',
            'driver_class' => '[driver class]',
        ])->execute();
    }

    public static function tearDownAfterClass()
    {
        _get('db')->update(':session_driver', ['is_default' => 0])
            ->where('driver_id<>?', 'database')
            ->execute();

        _get('db')->update(':session_driver', ['is_default' => 1])
            ->where('driver_id=?', 'database')
            ->execute();
    }

    public function testDatabase()
    {
        $mn = new SessionFactory();

        _get('db')->update(':session_driver', ['is_default' => 0])
            ->where('driver_id<>?', 'database')
            ->execute();

        _get('db')->update(':session_driver', ['is_default' => 1])
            ->where('driver_id=?', 'database')
            ->execute();


        $this->assertTrue($mn->factory() instanceof DatabaseSession);
    }

    public function testFiles()
    {
        $mn = new SessionFactory();

        _get('db')->update(':session_driver')
            ->values(['is_default' => 0])
            ->where('driver_id<>?', 'files')
            ->execute();

        _get('db')->update(':session_driver')
            ->values(['is_default' => 1])
            ->where('driver_id=?', 'files')
            ->execute();


        $this->assertTrue($mn->factory() instanceof FilesSession);
    }

    public function testRedis()
    {
        $mn = new SessionFactory();

        _get('db')->update(':session_driver', ['is_default' => 0])
            ->where('driver_id<>?', 'redis')
            ->execute();

        _get('db')->update(':session_driver', ['is_default' => 1])
            ->where('driver_id=?', 'redis')
            ->execute();


        $this->assertTrue($mn->factory() instanceof RedisSession);
    }

    public function testMemcache()
    {
        $mn = new SessionFactory();

        _get('db')->update(':session_driver', ['is_default' => 0])
            ->where('driver_id<>?', 'memcache')
            ->execute();

        _get('db')->update(':session_driver', ['is_default' => 1])
            ->where('driver_id=?', 'memcache')
            ->execute();


        $this->assertTrue($mn->factory() instanceof MemcacheSession);
    }
}
