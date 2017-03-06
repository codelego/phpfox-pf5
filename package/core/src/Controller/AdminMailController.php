<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminMailController extends AdminController
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

        $vm->setTemplate('core/admin-mail/index');

        return $vm;
    }

    public function actionTransports()
    {
        $items = \Phpfox::with('mail_adapter')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();

        $vm->setTemplate('core/admin-mail/transports');

        $vm->assign(['items' => $items]);

        return $vm;
    }

    public function actionAddTransport()
    {
        $vm = new ViewModel();

        $request = \Phpfox::get('request');
        $driverName = $request->get('driver_name');
        $vm->setTemplate('core/admin-mail/add-transport');
        $vm->assign(['driver_name' => $driverName]);

        if (empty($driverName)) {
            $items = \Phpfox::with('mail_driver')
                ->select()
                ->execute()
                ->all();

            $vm->assign(['items' => $items]);

            return $vm;
        }

        $driver = \Phpfox::with('mail_driver')
            ->findById($driverName);

        $formSettings = $driver->getFormSettings();

        $form = new $formSettings;

        if ($request->isPost()) {

        }

        $vm->assign(['form' => $form, 'driver' => $driver]);
        return $vm;
    }

    public function actionEditTransport()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $item = \Phpfox::with('mail_adapter')->findById($id);

        if (!$item) {

        }

        if ($request->isGet()) {

        }

        if ($request->isPost()) {

        }

        return null;
    }
}