<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\MailAdapter\TestEmailSettings;
use Neutron\Core\Form\Admin\MailDriver\SelectMailDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminEditSettingsProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminMailController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'mail';

    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'menu'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('Mail Settings', 'menu'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'mail');

        \Phpfox::get('menu.admin.buttons')->load('_core.mail.buttons');
    }

    public function actionSettings()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'core_mail',
        ]))->process();
    }

    public function actionIndex()
    {
        $select = \Phpfox::model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminListEntryProcess([
            'noLimit'  => true,
            'select'   => $select,
            'data'     => ['defaultValue' => \Phpfox::param('core.default_mailer_id')],
            'template' => 'core/admin-mail/manage-mail-adapter',
        ]))->process();
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');
        $driverName = $request->get('driver_id');

        if (!$driverName) {
            return new ViewModel([
                'form' => new SelectMailDriver(),
            ], 'layout/form-edit');
        }

        \Phpfox::redirect('admin.core.mail.adapter', ['action' => 'config', 'driver_id' => $driverName]);

    }

    public function actionConfig()
    {
        $request = \Phpfox::get('request');
        $driverId = $request->get('driver_id');

        $form = \Phpfox::get('core.adapter')
            ->getEditingForm($driverId, self::DRIVER_TYPE);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = \Phpfox::model('core_adapter')
                ->create([
                    'driver_id'   => $driverId,
                    'is_active'   => 0,
                    'driver_type' => self::DRIVER_TYPE,
                ]);

            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            \Phpfox::redirect('admin.core.mail.adapter');
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
        } elseif ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();
            \Phpfox::redirect('admin.core.mail.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionTest()
    {
        $req = \Phpfox::get('request');
        $adapterId = $req->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = \Phpfox::model('core_adapter')->findById($adapterId);

        $form = new TestEmailSettings([]);

        if ($req->isGet()) {
            $data = \Phpfox::param('test_mail');
            $form->populate($data);
        }

        if ($req->isPost() and $form->isValid($req->all())) {
            $data = $form->getData();
            $params = array_merge(json_decode($adapterEntry->getParams(), true), [
                'debug' => true,
            ]);
            $testEmail = [
                'to'      => [[$data['to'], null]],
                'subject' => $data['subject'],
                'body'    => $data['message'],
                'bodyAlt' => $data['message'],
            ];

            list($result, $message) = \Phpfox::get('mailer')
                ->test($adapterEntry->getDriverId(), $params, $testEmail);

            if (!$result) {
                return '<pre>' . $message . '</pre>';
            } else {
                return '<p class="alert alert-success">Send mail successfully.</p>';
            }
        }

        return new ViewModel(['form' => $form], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $entry = \Phpfox::get('core.adapter')->getAdapterById(\Phpfox::get('request')->get('adapter_id'));

        $entry->delete();

        \Phpfox::redirect('admin.core.mail.adapter');
    }

    /**
     * Set default adapter id
     * todo implement this method
     */
    public function actionDefault()
    {
        $request = \Phpfox::get('request');
        $adapterId = $request->get('adapter_id');

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
                ->where('driver_type = ?', 'mail')
                ->execute();

            $entry->setDefault(1);
            $entry->setActive(1);
            $entry->save();

            // do not put default to another type


            \Phpfox::get('core.setting')->updateValue('core.default_mailer_id', $adapterId);
        }
        \Phpfox::redirect('admin.core.mail.adapter');
    }
}