<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminMailController extends ActionController
{
    public function actionIndex()
    {

        $items = \Phpfox::db()
            ->select('*')
            ->from(':core_package')
            ->order('is_core, package_type', 1)
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $items,
        ]);

        $vm->setTemplate('core.admin-mail.index');

        return $vm;
    }
}