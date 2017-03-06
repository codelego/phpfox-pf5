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
        $request = \Phpfox::get('request');

        $filter = new AdminFilterUser();

        if ($request->isGet()) {
            $filter->populate($request->all());
        }

        $items = \Phpfox::with('user')
            ->select()
            ->limit(10)
            ->all();

        $vm->assign(['items' => $items, 'filter' => $filter]);

        $vm->setTemplate('user/admin-manage/index');

        return $vm;
    }
}