<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\User\Form\AdminFilterUser;
use Phpfox\View\ViewModel;

class AdminManageController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.user'), 'label' => 'Members',]);
    }

    public function actionIndex()
    {
        $request = _get('request');

        $filter = new AdminFilterUser();

        _get('registry')->set('search.filter', $filter);

        if ($request->isGet()) {
            $filter->populate($request->all());
        }
        $items = _with('user')
            ->select()
            ->limit(10)
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'user/admin-manage/index');
    }
}