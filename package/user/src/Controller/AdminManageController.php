<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\User\Form\AdminFilterUser;
use Phpfox\View\ViewModel;

class AdminManageController extends AdminController
{
    public function actionIndex()
    {
        \Phpfox::get('breadcrumb')
            ->add(['link' => '', 'label' => 'Members',], true);

        $vm = new ViewModel();
        $request = \Phpfox::get('request');

        $filter = new AdminFilterUser();

        \Phpfox::get('registry')->set('search.filter', $filter);

        if ($request->isGet()) {
            $filter->populate($request->all());
        }

        $items = \Phpfox::with('user')
            ->select()
            ->limit(10)
            ->all();

        $vm->assign(['items' => $items]);

        $vm->setTemplate('user/admin-manage/index');

        return $vm;
    }
}