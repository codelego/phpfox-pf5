<?php

namespace Neutron\Announcement\Controller;


use Phpfox\Kernel\Request;
use Phpfox\View\ViewModel;

class AdminManageControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testActionAddWithHttpGetMethod()
    {
        $obj = new AdminManageController();

        $request = Request::factory([
            'method' => 'get',
        ]);

        _get('manager')->set('request', $request);

        $vm = $obj->actionAdd();
        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotNull($vm->render());
    }

    public function testActionAddWithHttpPost()
    {
        $obj = new AdminManageController();

        $request = Request::factory([
            'method'        => 'post',
            'user_id'       => 2,
            'title'         => '[annoucement title]',
            'photo_file_id' => 22,
            'description'   => '[annoucement description]',
            'is_active'     => 1,
            'type_id'       => 0,
            'content'       => '[annoucement content]',
            'created_at'    => '2012-01-01 00:00:00',
            'updated_at'    => '2013-01-01 00:00:00',
            'publish_at'    => '2014-01-01 00:00:00',
            'expires_at'    => '2015-01-01 00:00:00',
        ]);

        _get('manager')->set('request', $request);

        $vm = $obj->actionAdd();
        $this->assertTrue($vm instanceof ViewModel);
        $this->assertNotNull($vm->render());
    }
}
