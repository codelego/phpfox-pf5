<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\User\Form\AdminFilterUser;
use Phpfox\View\ViewModel;

class AdminManageController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.user'), 'label' => 'Members',]);
    }

    public function actionIndex()
    {
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

        return new ViewModel([
            'items' => $items,
        ], 'user/admin-manage/index');
    }
}