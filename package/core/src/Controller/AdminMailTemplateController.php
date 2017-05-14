<?php

namespace Neutron\Core\Controller;


class AdminMailTemplateController extends AdminController
{
    protected function initialized()
    {
        _get('menu.admin.secondary')
            ->load('admin.core.mail');
    }

    protected function postDispatch($action)
    {
        switch ($action) {
            case 'index':
                _get('menu.admin.buttons')
                    ->load('admin.core.mail.template.buttons');
        }
    }

    public function actionIndex()
    {

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