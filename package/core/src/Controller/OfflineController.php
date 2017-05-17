<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;

class OfflineController extends ActionController
{
    public function actionIndex()
    {
        include PHPFOX_CONFIG_DIR . '/offline_access.html';
        exit(0);
    }

    public function actionOffline()
    {
        $offlineCode = _get('request')->get('offline_code');
        if ($offlineCode and _param('core.offline_code') == $offlineCode) {
            $_SESSION['offline_code'] = $offlineCode;
            _redirect('#');
        }

        include PHPFOX_CONFIG_DIR . '/offline.html';
        exit(0);
    }

    protected function passOfflineMode()
    {
        return true;
    }

    protected function passPrivateMode()
    {
        return true;
    }
}