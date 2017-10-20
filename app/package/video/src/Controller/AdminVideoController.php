<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Video\Form\Admin\Video\DeleteVideo;
use Neutron\Video\Form\Admin\Video\EditVideo;
use Neutron\Video\Form\Admin\Video\FilterVideo;
use Neutron\Video\Model\Video;

class AdminVideoController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Videos'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        _get('menu.admin.secondary')->load('admin', 'video');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'model'       => Video::class,
                'filter.form' => FilterVideo::class,
                'template'    => 'video/admin/manage-video',
            ]
        ))->process();

    }

    public function actionDelete()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'form'     => DeleteVideo::class,
            'model'    => Video::class,
            'redirect' => _url('admin.video.category'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'form'     => EditVideo::class,
            'model'    => Video::class,
            'redirect' => _url('admin.video.category'),
        ]))->process();
    }
}