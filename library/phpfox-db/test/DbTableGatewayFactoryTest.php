<?php

namespace Phpfox\Db;

use Phpfox\Mysqli\MysqliDbAdapter;

class MockExampleItem extends DbModel
{
    function getModelId()
    {
        return 'example_item';
    }
}

class DbTableGatewayFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected static $adapter;

    protected static function getAdapter()
    {
        if (null == self::$adapter) {
            self::$adapter = new MysqliDbAdapter([
                'host'     => '127.0.0.1',
                'password' => 'namnv123',
                'user'     => 'root',
                'database' => 'phpfox_v5',
            ]);
        }

        return self::$adapter;
    }

    public static function setUpBeforeClass()
    {
        self::getAdapter()->execute('CREATE TABLE IF NOT EXISTS `'
            . PHPFOX_TABLE_PREFIX . 'example_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32)  DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `value` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;');
    }

    public static function tearDownAfterClass()
    {
        self::getAdapter()->execute('DROP TABLE IF EXISTS '
            . PHPFOX_TABLE_PREFIX . 'example_item;');

        @unlink(PHPFOX_PACKAGE_DIR .'.example_item.php');
    }

    public function testBase()
    {
        $gateway = (new DbTableGatewayFactory())->factory('example_item',
            ':example_item',
            MockExampleItem::class,
            '.example_item.php');

        $result = $gateway->insert([
            'name'=>'name 1',
            'value'=>'value 1',
            'category_id'=>'1',
        ]);
        
        $this->assertTrue($result->isValid());
        $this->assertEquals(1, $result->lastId());

    }
}
