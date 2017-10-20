<?php

namespace Neutron\Photo\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminPhotoController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')->set(_text('Photos'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.photo'), 'label' => _text('Photos')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'photo');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'model'       => Photo::class,
                'filter.form' => FilterPhoto::class,
                'template'    => 'photo/admin/manage-photo',
            ]
        ))->process();

    }
}