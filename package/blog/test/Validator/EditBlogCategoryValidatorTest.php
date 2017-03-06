<?php

namespace Neutron\Blog\Validator;

class EditBlogCategoryValidatorTest extends \PHPUnit_Framework_TestCase
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

    public function testNameRequired()
    {
        $obj = new EditBlogCategoryValidator();

        $this->assertFalse($obj->isValid(['name' => '']));

    }

    public function testNameTooLong()
    {
        $obj = new EditBlogCategoryValidator();

        $this->assertFalse($obj->isValid(['name' => 'Note: This parameter is intended exclusively for YouTube content partners. The onBehalfOfContentOwner parameter indicates that the request\'s authorization credentials identify a YouTube CMS user who is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The CMS account that the user authenticates with must be linked to the specified YouTube content owner. (string)']));
    }

    public function testNameDuplicated()
    {
        $obj = new EditBlogCategoryValidator();

        $this->assertFalse($obj->isValid(['name' => 'example name']));
    }


    public function testIsActiveRequired()
    {
        $obj = new EditBlogCategoryValidator();
        $data = ['name' => 'example name ' . time(),];
        $this->assertFalse($obj->isValid($data));
    }
}
