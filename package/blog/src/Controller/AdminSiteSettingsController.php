<?php

namespace Neutron\Blog\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSiteSettingsProcess;

class AdminSiteSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Blogs'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        _service('menu.admin.secondary')->load('admin.blog');

    }

    public function actionIndex()
    {
        return (new AdminEditSiteSettingsProcess([
            'setting_group' => 'blog',
        ]))->process();
    }
}