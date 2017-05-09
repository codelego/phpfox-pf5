<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Model\CoreSettingGroup;
use Neutron\Core\Process\AdminEditSiteSettingsProcess;

class AdminSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Manage Settings', 'admin'));

        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.settings'),
                'label' => _text('Manage Settings', 'admin'),
            ]);
    }

    public function actionIndex()
    {

    }

    public function actionEdit()
    {
        return (new AdminEditSiteSettingsProcess([]))->process();
    }
}