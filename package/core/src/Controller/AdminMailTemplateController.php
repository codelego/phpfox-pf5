<?php

namespace Neutron\Core\Controller;


class AdminMailTemplateController extends AdminController
{
    protected function initialized()
    {
        _service('menu.admin.secondary')
            ->load('admin.core.mail');
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