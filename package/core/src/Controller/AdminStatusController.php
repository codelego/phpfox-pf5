<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\LicenseSettings;
use Phpfox\View\ViewModel;

class AdminStatusController extends AdminController
{
    public function actionCache()
    {

    }

    public function actionLicense()
    {
        $vm = new ViewModel();

        $form = new LicenseSettings();

        $vm->assign([
            'heading' => 'License Information',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout/admin-edit');

        return $vm;
    }

    public function actionHealthCheck()
    {
        $vm = new ViewModel();

        $response = _emit('onSystemHealthCheck');


        $vm->setTemplate('core/admin-status/health-check');

        $vm->assign([
            'items' => $response,
        ]);

        return $vm;
    }

    public function actionStatistics()
    {
        $vm = new ViewModel();

        $response = _emit('onSiteStatistics');

        $vm->setTemplate('core/admin-status/statistics');

        $vm->assign([
            'items' => $response,
        ]);

        return $vm;

    }

    public function actionOverview()
    {
        $vm = new ViewModel();

        $status = [
            [
                'label' => 'PHP Version',
                'value' => sprintf('<strong class="text-danger">%s</strong>',
                    PHP_VERSION),
            ],
            ['label' => 'php_sapi', 'value' => php_sapi_name()],
            [
                'label' => 'safe_mode',
                'value' => _yesno(@ini_get('safe_mode') == 1
                    || strtolower(@ini_get('safe_mode')) == 'on'),
            ],
            [
                'label' => 'open_basedir',
                'value' => _yesno(($sBd = @ini_get('open_basedir'))
                    && $sBd != '/'),
            ],
            [
                'label' => 'server time',
                'value' => date('Y-m-d H:i:s (e)', time()),
            ],
            ['label' => 'operating_system', 'value' => PHP_OS],
            [
                'label' => 'php_loaded_extensions',
                'value' => implode(', ', get_loaded_extensions()),
            ],
        ];

        if (function_exists('ini_get_all')) {
            foreach (@ini_get_all() as $key => $row) {
                $value = $row['local_value'];
                if (null === $value || '' === $value) {
                    $value = '';
                }
                $status[] = ['label' => $key, 'value' => $value];
            }
        }
        $vm->assign([
            'status' => $status,
        ]);

        $vm->setTemplate('core/admin-status/overview');

        return $vm;
    }
}