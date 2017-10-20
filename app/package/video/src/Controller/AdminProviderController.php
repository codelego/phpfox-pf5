<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Video\Model\VideoProvider;
use Phpfox\Form\Form;

class AdminProviderController extends AdminController
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
                'filter.form' => null,
                'model'       => VideoProvider::class,
                'template'    => 'video/admin/manage-provider',
            ]
        ))->process();

    }

    public function actionEdit()
    {
        $req = _get('request');
        $identity = $req->get('provider_id');


        /** @var VideoProvider $entry */
        $entry = _find('video_provider', $identity);


        return (new AdminEditSettingsProcess(
            ['form' => $entry->getFormSettingsClass()]
        ))->process();

    }
}