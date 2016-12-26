<?php

namespace Phpfox\Mysqli;

use Phpfox\Db\DbAdapterInterface;
use Phpfox\Db\SqlLiteral;
use Phpfox\Db\SqlSelect;
use Phpfox\Db\SqlUpdate;

class MysqliAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testTransaction()
    {
        $adapter = new MysqliDbAdapter([
            'host'     => '127.0.0.1',
            'port'     => '3306',
            'database' => 'phpfox_v5',
            'user'     => 'root',
            'password' => 'namnv123',
        ]);

        $this->assertNotNull($adapter->getMaster());

        $this->assertFalse($adapter->inTransaction());

        $adapter->begin();

        $this->assertTrue($adapter->inTransaction());

        $adapter->commit();

        $this->assertFalse($adapter->inTransaction());

        $adapter->begin();

        $this->assertTrue($adapter->inTransaction());

        $adapter->rollback();

        $this->assertFalse($adapter->inTransaction());

        $adapter->connect();

        $adapter->disconnect();

        $adapter->reconnect();

        $adapter->tables();
    }

    /**
     * @expectedException  \Phpfox\Db\SqlException
     */
    public function testSqlException()
    {
        $db = $this->getAdapter();
        $db->select('*')->from('phpfox_notable')
            ->where('1')
            ->execute();

    }

    /**
     * @return DbAdapterInterface
     */
    public function getAdapter()
    {
        return \Phpfox::get('db');
    }

    public function testSqlSelect()
    {
        $adapter = $this->getAdapter();

        $sqlSelect = new SqlSelect($adapter);

        $sqlResult = $sqlSelect->select('*')->select('user_id')
            ->from('phpfox_user')->where('user_id=1')->execute();

        $this->assertTrue($sqlResult->isValid());

        $sqlResult->all();
    }

    public function testSqlInsert()
    {
        $adapter = $this->getAdapter();

        $sqlUpdate = new SqlUpdate($adapter);

        $username = 'namnv';
        $result = $sqlUpdate->update('phpfox_user')
            ->values(['user_name' => $username])->where(['user_id=?' => 1])
            ->execute(); // do not forget execute for that trim.

        $this->assertTrue($result->isValid(), 'Can not update user');
    }

    public function testPackages()
    {
        $result = \Phpfox::getDb()->select()->from(':core_package')->select('*')
            ->where('is_active=?', 1)->order('is_core', 1)->order('priority', 1)
            ->execute();

        $result = $result->all();

        $this->assertNotEmpty($result);

    }

    /**
     * @expectedException \Phpfox\Db\DbConnectException
     */
    public function testNoHost()
    {
        $db = new MysqliDbAdapter([
            'host'    => null,
            'port'    => null,
            'masters' => [],
        ]);

        $db->connect();
    }

    /**
     * @expected
     */
    public function testEmptyPort()
    {
        $db = new MysqliDbAdapter([
            'host'     => '127.0.0.1',
            'port'     => null,
            'user'     => 'root',
            'password' => 'namnv123',
        ]);

        $db->connect();

        $this->assertNotEmpty($db->getMaster());
    }

    /**
     * @expectedException \Phpfox\Db\DbConnectException
     */
    public function testConnectFailure()
    {
        $db = new MysqliDbAdapter([
            'host'     => '127.0.0.1',
            'port'     => null,
            'user'     => 'root',
            'password' => '',
        ]);

        $db->connect();
    }

    public function testCommit()
    {
        $db = new MysqliDbAdapter([
            'host'     => '127.0.0.1',
            'port'     => '3306',
            'user'     => 'root',
            'password' => 'namnv123',
            'database' => 'phpfox_v5',
        ]);

        $db->error();

        $this->assertTrue($db->begin());
        $this->assertFalse($db->begin());
        $db->commit();

        $db->begin();
        $db->rollback();

        $db->commit();

        $db->commit();
        
        $this->assertEquals('`id`', $db->quoteIdentifier('id'));
        
        $this->assertEquals('1', $db->quoteValue(true));
        $this->assertEquals('0', $db->quoteValue(false));

        $this->assertEquals('NULL', $db->quoteValue(null));
        $this->assertEquals('1, 2, 3', $db->quoteValue([1,2,3]));
        
        $this->assertEquals('test literal', $db->quoteValue(new SqlLiteral('test literal')));
    }
}
