<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\User\Form\AdminFilterUser;
use Phpfox\View\ViewModel;

class AdminManageController extends AdminController
{
    public function actionIndex()
    {
        $vm = new ViewModel();

        $filter = new AdminFilterUser();

        if (!empty($_GET)) {
            $filter->populate($_GET);
        }

        $items = \Phpfox::getModel('user')
            ->select()
            ->limit(10)
            ->execute()
            ->all();

        $vm->assign(['items' => $items, 'filter' => $filter]);

        $vm->setTemplate('user.admin-manage.index');

        return $vm;
    }
}