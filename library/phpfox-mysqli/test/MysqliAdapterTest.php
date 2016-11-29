<?php

namespace Phpfox\Mysqli;


use Phpfox\Db\SqlSelect;
use Phpfox\Db\SqlUpdate;

class MysqliAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testTransaction()
    {
        $adapter = $this->getAdapter();

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
    }

    public function getAdapter()
    {
        return service('db');
    }

    public function testSqlSelect()
    {
        $adapter = $this->getAdapter();

        $sqlSelect = new SqlSelect($adapter);

        $sqlResult = $sqlSelect->select('*')->select('user_id')
            ->from('phpfox_user')->where('user_id=1')->execute();

        $this->assertTrue($sqlResult->isValid());

        $sqlResult->fetch();
    }

    public function testSqlInsert()
    {
        $adapter = $this->getAdapter();

        $sqlUpdate = new SqlUpdate($adapter);

        $result = $sqlUpdate->update('phpfox_user')
            ->values(['user_name' => 'namnv'])->where(['user_id=?' => 1])
            ->execute(); // do not forget execute for that trim.

        $this->assertTrue($result->isValid(), 'Can not update user');
    }

    public function testPackages()
    {
        $result = service('db')
            ->sqlSelect()
            ->from(':core_package')
            ->select('*')
            ->where('is_active=?', 1)
            ->order('is_core', 1)
            ->order('priority', 1)
            ->execute();

        $result = $result->fetch();
        $data = [];
        foreach ($result as $row) {
            $configFilename = PHPFOX_DIR . '/' . $row->path
                . '/config/module.config.php';
            $data = array_merge_recursive($data, include $configFilename);
        }

        $autoloader = service('autoloader');
        foreach ($data['psr4'] as $k => $vs) {
            foreach ($vs as $v) {
                $autoloader->addPsr4($k, PHPFOX_DIR . DS . $v);
            }
        }
        service('log')->info(var_export($data, true));
    }
}
