<?php

namespace Phpfox\Db;


use Phpfox\Mysqli\MysqliDbAdapter;

class SqlTest extends \PHPUnit_Framework_TestCase
{
    protected static $adapter;

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
    }

    public function testLiteral()
    {
        $literal = new SqlLiteral('example_value');

        $this->assertEquals('example_value', $literal->getLiteral());
        $this->assertEquals('example_value', $literal->__toString());

        $literal->setLiteral('example value 2');

        $this->assertEquals('example value 2', $literal->getLiteral());
        $this->assertEquals('example value 2', $literal->__toString());
    }

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

    public function testSqlInsert()
    {
        $adapter = $this->getAdapter();

        $sqlInsert = new SqlInsert($adapter);

        $data = [
            'name'        => 'example item ' . time(),
            'category_id' => 1,
            'value'       => 'example value ' . time(),
        ];
        $result = $sqlInsert->insert('pf5_example_item')
            ->values($data)->execute(null, true);

        $this->assertTrue($result->isValid());

        $sqlSelect = new SqlSelect($adapter);

        $actual = $sqlSelect->select('*')
            ->from('pf5_example_item')
            ->where('id=?', $result->lastId())
            ->execute()
            ->first();

        unset($actual['id']);

        $this->assertEquals($data, $actual);

    }

    public function testSqlInsertShortcut()
    {
        $adapter = $this->getAdapter();

        $sqlInsert = new SqlInsert($adapter);

        $data = [
            'name'        => 'example item ' . time(),
            'category_id' => 1,
            'value'       => 'example value ' . time(),
        ];
        $result = $sqlInsert->insert(':example_item')
            ->values($data)
            ->execute();

        $this->assertTrue($result->isValid());

        $sqlSelect = new SqlSelect($adapter);

        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', $result->lastId())
            ->execute()
            ->first();

        unset($actual['id']);

        $this->assertEquals($data, $actual);

    }

    public function testSqlInsertDelay()
    {
        $adapter = $this->getAdapter();

        $sqlInsert = new SqlInsert($adapter);

        $data = [
            'name'        => 'example item ' . time(),
            'category_id' => 1,
            'value'       => 'example value ' . time(),
        ];
        $result = $sqlInsert->insert('pf5_example_item')
            ->values($data)
            ->setDelay(1)
            ->execute();

        $this->assertNotNull($sqlInsert->isDelay());

        $this->assertTrue($result->isValid());

        $sqlSelect = new SqlSelect($adapter);

        $actual = $sqlSelect->select('*')
            ->from('pf5_example_item')
            ->where('id=?', $result->lastId())
            ->execute()
            ->first();

        unset($actual['id']);

        $this->assertEquals($data, $actual);

    }

    public function testSqlInsertIgnore()
    {
        $adapter = $this->getAdapter();

        $sqlInsert = new SqlInsert($adapter);

        $data = [
            'name'        => 'example item ' . time(),
            'category_id' => 1,
            'value'       => 'example value ' . time(),
        ];
        $result= $sqlInsert->insert(':example_item')
            ->values($data)
            ->ignoreOnDuplicate(1)
            ->execute();

        $this->assertTrue($result->isValid());

        $sqlSelect = new SqlSelect($adapter);

        $actual = $sqlSelect->select('*')
            ->from('pf5_example_item')
            ->where('id=?', $result->lastId())
            ->execute()
            ->first();

        unset($actual['id']);

        $this->assertEquals($data, $actual);

    }

    /**
     * @expectedException \Phpfox\Db\SqlException
     */
    public function testSqlInsertFailure()
    {
        $adapter = $this->getAdapter();

        $sqlInsert = new SqlInsert($adapter);

        $data = [
            'no_column'   => 1,
            'name'        => 'example item ' . time(),
            'category_id' => null,
            'value'       => null,
        ];
        $sqlInsert->insert(':example_item')
            ->values($data)
            ->execute();
    }

    public function testSqlJoin()
    {
        $sqlJoin = new SqlJoin($this->getAdapter());

        $sqlJoin->join('LEFT JOIN', ':example_item', 'a', 'a.id=b.id', null);

        $this->assertEquals('LEFT JOIN pf5_example_item AS a ON (a.id=b.id) ',
            $sqlJoin->prepare());
    }

    public function testSqlJoin2()
    {
        $sqlJoin = new SqlJoin($this->getAdapter());

        $sqlJoin->join('LEFT JOIN', ':example_item', 'a',
            'a.id=b.id and a.id=?', '1');

        $this->assertEquals('LEFT JOIN pf5_example_item AS a ON (a.id=b.id and a.id=\'1\') ',
            $sqlJoin->prepare());
    }

    public function testSqlJoin3()
    {
        $sqlJoin = new SqlJoin($this->getAdapter());

        $sqlJoin->join('LEFT JOIN', ':example_item', 'a',
            'a.id=b.id and a.id =:id and a.value=:value', [
                ':id'    => 1,
                ':value' => 2,
            ]);

        $this->assertEquals('LEFT JOIN pf5_example_item AS a ON (a.id=b.id and a.id =1 and a.value=2) ',
            $sqlJoin->prepare());
    }

    public function testSqlSelectOrder1()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id ASC'));
    }

    public function testSqlSelectOrder2()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', 'asc')
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id ASC'));
    }

    public function testSqlSelectOrder3()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', 'ASC')
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id ASC'));
    }

    public function testSelectOrder4()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', -1)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id DESC'));
    }

    public function testSelectOrder5()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', 'desc')
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id DESC'));
    }

    public function testSelectOrder6()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', 'DESC')
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id DESC'));
    }

    public function testSelectOrder7()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'ORDER BY id'));
    }

    public function testSelectColumn1()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->select('id')
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'SELECT id FROM'));
    }

    public function testSelectColumn2()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->select('id')
            ->andSelect('name')
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'SELECT id, name FROM'), $actual);
    }

    public function testSelectColumn3()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->select(['id', 'name'])
            ->andSelect(['value'])
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'SELECT id, name, value FROM'),
            $actual);
    }

    public function testSelectForUpdate()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item')
            ->where('id=?', 1)
            ->forUpdate()
            ->useMaster(true)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'FOR UPDATE'), $actual);
    }

    public function testSelectFrom1()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a', 'id')
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'SELECT id FROM ' . PHPFOX_TABLE_PREFIX . 'example_item AS a'),
            $actual);
    }

    public function testSelectFrom2()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a', ['id', 'name'])
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'SELECT id, name FROM ' . PHPFOX_TABLE_PREFIX
            . 'example_item AS a'), $actual);
    }

    public function testSelectFrom3()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a', 'id,name')
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'SELECT id,name FROM ' . PHPFOX_TABLE_PREFIX . 'example_item AS a'),
            $actual);
    }

    public function testSelectFrom4()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('id,name')
            ->from(':example_item', 'a', null)
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'SELECT id,name FROM ' . PHPFOX_TABLE_PREFIX . 'example_item AS a'),
            $actual);
    }

    public function testSelectFrom5()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('id,name')
            ->from(':example_item', 'a', null)
            ->andSelect('value')
            ->where('id=?', 1)
            ->order('id', null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'SELECT id,name, value FROM ' . PHPFOX_TABLE_PREFIX
            . 'example_item AS a'), $actual);
    }

    public function testSelectWhere1()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->where('id=?', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'WHERE  (id=1)'), $actual);
    }

    public function testSelectWhere2()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->where('id=?', 1)
            ->orWhere('id=?', 2)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'WHERE  (id=1)  OR  (id=2)'),
            $actual);
    }

    public function testSelectWhere3()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->orWhere('id=?', 2)
            ->where('id=?', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'WHERE  (id=2)  AND  (id=1) '),
            $actual);
    }

    public function testSelectHaving1()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->where('id=?', 1)
            ->having('name=?', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'HAVING  (name=1)'), $actual);
    }

    public function testSelectHaving2()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->where('id=?', 1)
            ->having('name=?', 1)
            ->orHaving('name=?', 2)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'HAVING  (name=1)  OR  (name=2) '), $actual);
    }

    public function testSelectHaving3()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->where('id=?', 1)
            ->orHaving('name=?', 2)
            ->having('name=?', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'HAVING  (name=2)  AND  (name=1) '), $actual);
    }

    public function testSqlGroup1()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->group('name')
            ->prepare();

        $this->assertNotFalse(strpos($actual, 'GROUP BY name'), $actual);
    }

    public function testSqlJoin4()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->join(':example_item', 'b', 'a.id=b.id', null, null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'JOIN pf5_example_item AS b ON (a.id=b.id) '), $actual);
    }

    public function testSqlJoin5()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->leftJoin(':example_item', 'b', 'a.id=b.id', null, null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'LEFT JOIN pf5_example_item AS b ON (a.id=b.id) '), $actual);
    }

    public function testSqlJoin6()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->rightJoin(':example_item', 'b', 'a.id=b.id', null, null)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'RIGHT JOIN pf5_example_item AS b ON (a.id=b.id) '), $actual);
    }

    public function testSqlJoin7()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->join(':example_item', 'b', 'a.id=b.id', null, ['b.id'])
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'JOIN pf5_example_item AS b ON (a.id=b.id) '), $actual);
    }

    public function testSqlJoin8()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->leftJoin(':example_item', 'b', 'a.id=b.id', null, ['b.id'])
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'LEFT JOIN pf5_example_item AS b ON (a.id=b.id) '), $actual);
    }

    public function testSqlJoin9()
    {
        $sqlSelect = new SqlSelect($this->getAdapter());
        $actual = $sqlSelect->select('*')
            ->from(':example_item', 'a')
            ->rightJoin(':example_item', 'b', 'a.id=b.id', null, ['b.id'])
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'RIGHT JOIN pf5_example_item AS b ON (a.id=b.id) '), $actual);
    }

    public function testSqlDelete1()
    {
        $delete = new SqlDelete(self::getAdapter());

        $actual = $delete->from(':example_item')
            ->where('id=?', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'DELETE FROM ' . PHPFOX_TABLE_PREFIX
            . 'example_item WHERE  (id=1)'), $actual);

    }

    public function testSqlDelete2()
    {
        $delete = new SqlDelete(self::getAdapter());

        $actual = $delete->from(':example_item')
            ->where('id=?', 1)
            ->orWhere('id=?', 2)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'DELETE FROM ' . PHPFOX_TABLE_PREFIX
            . 'example_item WHERE  (id=1)  OR  (id=2)'), $actual);

    }

    public function testSqlDelete3()
    {
        $delete = new SqlDelete(self::getAdapter());

        $actual = $delete->from(':example_item')
            ->orWhere('id=?', 2)
            ->where('id=?', 1)
            ->prepare();

        $this->assertNotFalse(strpos($actual,
            'DELETE FROM ' . PHPFOX_TABLE_PREFIX
            . 'example_item WHERE  (id=2)  AND  (id=1)'), $actual);

    }

    /**
     * @expectedException \Phpfox\Db\SqlException
     */
    public function testSqlDelete4()
    {
        $delete = new SqlDelete(self::getAdapter());

        $result  = $delete->from(':example_item')
            ->where('aid=?', 1)
            ->execute();

        $this->assertNull($result);
    }

    /**
     * @expectedException \Phpfox\Db\SqlException
     */
    public function testSqlDelete5()
    {
        $delete = new SqlDelete(self::getAdapter());

        $result  = $delete->from(':example_item')
            ->orWhere('aid=?', 1)
            ->execute();

        $this->assertTrue($result);
    }

    public function testModels()
    {
        $actual =  (new SqlSelect(self::getAdapter()))
            ->select('*')
            ->from(':example_item')
            ->where('id=?',1)
            ->execute()
            ->setPrototype(\stdClass::class)
            ->all();
        
        $this->assertEquals(1, count($actual));
    }

    public function testFirstModels()
    {
        $actual =  (new SqlSelect(self::getAdapter()))
            ->select('*')
            ->from(':example_item')
            ->where('id=?',1)
            ->execute()
            ->setPrototype(\stdClass::class)
            ->first();

        $this->assertInstanceOf('\stdClass', $actual);
    }

}