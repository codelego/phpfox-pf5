<?php

namespace Neutron\Core\Controller;

use Phpfox\Kernel\ActionController;

class OfflineController extends ActionController
{
    public function actionIndex()
    {
        include PHPFOX_CONFIG_DIR . '/offline_access.html';
        exit(0);
    }

    public function actionOffline()
    {

        $offlineCode = \Phpfox::get('request')->get('offline_code');
        if ($offlineCode and \Phpfox::param('core.offline_code') == $offlineCode) {
            $_SESSION['offline_code'] = $offlineCode;

            \Phpfox::redirect('#');
        }


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