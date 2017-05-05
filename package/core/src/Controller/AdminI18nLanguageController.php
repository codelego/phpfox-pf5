<?php

namespace Neutron\Core\Controller;


use Phpfox\View\ViewModel;

class AdminI18nLanguageController extends AdminController
{

    protected function initialized()
    {
        _service('menu.admin.secondary')->load('admin.core.i18n');
    }

    public function actionIndex()
    {
        $items = _model('i18n_language')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-i18n/manage-language');
    }

    public function actionAdd()
    {

    }

    public function actionEdit()
    {

    }

    public function actionDelete()
    {

    }
}