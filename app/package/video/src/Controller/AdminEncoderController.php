<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Video\Model\VideoEncoder;

class AdminEncoderController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Videos'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'video');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'filter.form' => null,
                'model'       => VideoEncoder::class,
                'template'    => 'video/admin/manage-encoder',
            ]
        ))->process();

    }

    public function actionEdit()
    {
        $req = \Phpfox::get('request');
        $identity = $req->get('encoder_id');


        /** @var VideoEncoder $entry */
        $entry = \Phpfox::find('video_encoder', $identity);

        return (new AdminEditSettingsProcess(
            ['form' => $entry->getFormSettingsClass()]
        ))->process();

    }
}