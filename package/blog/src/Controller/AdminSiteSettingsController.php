<?php

namespace Neutron\Blog\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;

class AdminSiteSettingsController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Blogs'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        _get('menu.admin.secondary')->load('admin.blog');

    }

    public function actionIndex()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'blog',
        ]))->process();
    }
}