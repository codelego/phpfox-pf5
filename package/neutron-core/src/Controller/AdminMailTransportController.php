<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminMailTransportController extends ActionController
{
    public function actionIndex()
    {

        $items = \Phpfox::getDb()
            ->select('*')
            ->from(':core_package')
            ->order('is_core, package_type', 1)
            ->execute()
            ->all();

        return new ViewModel('core.admin-mail-transport.index', [
            'items' => $items,
        ]);
    }
}