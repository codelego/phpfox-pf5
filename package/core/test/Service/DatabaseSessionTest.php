<?php

namespace Neutron\Core\Service;


class DatabaseSessionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new DatabaseSession();

        $id = 'test_id';
        $path = '/';
        $data = 'test_data';

        $this->assertSame(true, $obj->destroy($id));
        $this->assertSame(true, $obj->open($id, $path));
        $this->assertSame(true, $obj->close());
        $this->assertSame('', $obj->read($id));
        $this->assertSame(true, $obj->write($id, $data));
        $this->assertSame(true, $obj->write($id, $data));
        $this->assertSame($data, $obj->read($id));
        $this->assertSame(true, $obj->gc(0));

        $this->assertSame(true, $obj->destroy($id));
    }
}
