<?php

namespace Neutron\Blog\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Blogs'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        \Phpfox::get('menu.admin.buttons')->load('_blog.buttons');
        \Phpfox::get('menu.admin.secondary')->load('admin', 'blog');

    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'blog',
        ]))->process();
    }
}