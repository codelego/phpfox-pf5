<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\SessionDriver\SelectSessionDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminEditSettingsProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminSessionController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'session';

    protected function afterInitialize()
    {
        \Phpfox::get('html.title')->set(_text('Session Settings', 'menu'));

        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.session'),
                'label' => _text('Session Settings', 'menu'),
            ]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'session');

        \Phpfox::get('menu.admin.buttons')->load('_core.session.buttons');
    }

    public function actionIndex()
    {
        $select = \Phpfox::model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminListEntryProcess([
            'select'   => $select,
            'template' => 'core/admin-session/manage-session-adapter',
            'data'     => ['defaultValue' => \Phpfox::param('core.default_session_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminEditSettingsProcess(
            ['form_id' => 'core_session',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectSessionDriver(),
            ], 'layout/form-edit');
        }

        \Phpfox::redirect('admin.core.session', [
            'action'    => 'config',
            'driver_id' => $driverId,
        ]);
    }

    public function actionConfig()
    {
        $request = \Phpfox::get('request');
        $driverId = $request->get('driver_id');

        $form = \Phpfox::get('core.adapter')
            ->getEditingForm($driverId, 'session');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();

            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = \Phpfox::model('core_adapter')
                ->create([
                    'driver_id'   => $driverId,
                    'driver_type' => self::DRIVER_TYPE,
                    'is_active'   => 0,
                    'is_required' => 0,
                    'title'       => $data['title'],
                    'params'      => json_encode($data),
                    'description' => '',
                ]);
            // how to get name
            $adapterEntry->save();

            \Phpfox::redirect('admin.core.session');
        }


        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = \Phpfox::get('request');
        $adapterId = $request->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = \Phpfox::model('core_adapter')->findById($adapterId);

        $form = \Phpfox::get('core.adapter')
            ->getEditingForm($adapterEntry->getDriverId(), self::DRIVER_TYPE);

        if ($request->isGet()) {
            $data = json_decode($adapterEntry->getParams(), true);
            $data = array_merge($data, $adapterEntry->toArray());
            $form->populate($data);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            \Phpfox::redirect('admin.core.session');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $entry = \Phpfox::get('core.adapter')->getAdapterById(\Phpfox::get('request')->get('adapter_id'));

        $entry->delete();

        \Phpfox::redirect('admin.core.session');
    }

    public function actionDefault()
    {
        $adapterId = \Phpfox::get('request')
            ->get('adapter_id');

        /** @var CoreAdapter $entry */
        $entry = \Phpfox::model('core_adapter')->findById($adapterId);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "adapter_id"');
        }

        if (!$entry->isDefault()) {

            \Phpfox::model('core_adapter')
                ->update()
                ->values(['is_default' => 0])
                ->where('adapter_id <> ?', $adapterId)
                ->where('driver_type = ?', self::DRIVER_TYPE)
                ->execute();


            $entry->setDefault(1);
            $entry->setActive(1);
            $entry->save();
            \Phpfox::get('core.setting')->updateValue('core.default_session_id', $adapterId);
        }


        \Phpfox::redirect('admin.core.session');
    }
}