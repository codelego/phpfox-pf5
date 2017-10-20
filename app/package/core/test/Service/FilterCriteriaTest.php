<?php

namespace Neutron\Core\Service;


use Phpfox\Kernel\FilterCriteria;

class FilterCriteriaTest extends \PHPUnit_Framework_TestCase
{
    public function testInt()
    {
        $obj = new FilterCriteria([
            'a' => '12344',
            'b' => 2344,
            'c' => '12.4',
            'd' => null,
            'e' => false,
        ]);

        $this->assertSame(true, $obj->isInt('a'));
        $this->assertSame(true, $obj->isInt('b'));
        $this->assertSame(false, $obj->isInt('c'));
        $this->assertSame(false, $obj->isInt('d'));
        $this->assertSame(false, $obj->isInt('e'));
        $this->assertSame(false, $obj->isInt('f'));
    }
}
