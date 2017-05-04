<?php

namespace Phpfox\Navigation;


class NavigationItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NavigationItem
     */
    protected $item;

    public function testBase()
    {
        $this->item = new NavigationItem([
            'id'     => 1,
            'name'   => 'test',
            'href'   => null,
            'params' => ['key1' => 'value1', 'key2' => 'value2'],
            'route'  => null,
        ]);

        $this->assertSame(1, $this->item->id);
        $this->assertSame('test', $this->item->name);
        $this->assertSame(null, $this->item->href);
        $this->assertSame(['key1' => 'value1', 'key2' => 'value2'],
            $this->item->params);
        $this->assertNull($this->item->route);

        $this->item->id = 4;

        $this->assertSame(4, $this->item->id);

    }
}
