<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\LicenseSettings;
use Phpfox\View\ViewModel;

class AdminStatusController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->clear()
            ->add(['label'=>'System Status']);
    }

    public function actionCache()
    {

    }

    public function actionLicense()
    {
        $form = new LicenseSettings();

        return new ViewModel([
            'heading' => 'License Information',
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionHealthCheck()
    {
        $response = _emit('onSystemHealthCheck');

        return new ViewModel([
            'items' => $response,
        ], 'core/admin-status/health-check');
    }

    public function actionStatistics()
    {
        $response = _emit('onSiteStatistics');

        return new ViewModel([
            'items' => $response,
        ], 'core/admin-status/statistics');
    }

    public function actionOverview()
    {
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
        return new ViewModel([
            'status' => $status,
        ], 'core/admin-status/overview');
    }
}