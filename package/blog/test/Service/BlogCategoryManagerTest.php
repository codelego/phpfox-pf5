<?php

namespace Neutron\Blog\Service;


class BlogCategoryManagerTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        try {
            \Phpfox::db()->insert(':blog_category', [
                'name'        => 'example name',
                'is_active'   => 1,
                'description' => 'example description',
            ])->execute();
        } catch (\Exception $ex) {

        }
    }

    public function testHasName()
    {
        $obj = new BlogCategoryManager();
        $this->assertTrue($obj->hasName('example name'));
    }


}
