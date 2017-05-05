<?php

namespace Neutron\User\Service;


use Neutron\User\Model\User;

class ProfileNameFilterTest extends \PHPUnit_Framework_TestCase
{

    public function testOnCompileByEmptyName()
    {
        $obj = new ProfileNameFilter();

        $params = [];

        $this->assertFalse($obj->onCompile($params));
    }

    public function testOnCompileByInvalidName()
    {
        $obj = new ProfileNameFilter();

        $params = ['name' => 'namnv'];

        $this->assertTrue($obj->onCompile($params));
    }

    /**
     * @return string
     */
    public function testGetValidName()
    {
        /** @var User $obj */
        $obj = _model('user')
            ->select()
            ->where('username != ?', '')
            ->first();

        $this->assertTrue($obj instanceof User);

        return $obj->getUsername();

    }

    /**
     * @param $name
     *
     * @depends testGetValidName
     */
    public function testOnMatchByValidName($name)
    {
        $obj = new ProfileNameFilter();

        $params = ['name' => $name];

        $this->assertTrue($obj->onMatch($params));
    }

    public function testOnMatchByEmptyName()
    {
        $obj = new ProfileNameFilter();

        $params = [];
        $this->assertFalse($obj->onMatch($params));

        $params = ['name' => null];
        $this->assertFalse($obj->onMatch($params));

        $params = ['name' => ''];
        $this->assertFalse($obj->onMatch($params));
    }

    public function testOnMatchByInvalidName()
    {
        $obj = new ProfileNameFilter();

        $params = ['name' => 'empty name'];

        $this->assertFalse($obj->onMatch($params));
    }
}
