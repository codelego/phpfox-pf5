<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;
use Neutron\Core\Form\Admin\MailAdapter\TestEmailSettings;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminManageEntryProcess;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminMailController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'mail';

    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'menu'),
            ]);

        _service('html.title')
            ->set(_text('Mail Settings', 'menu'));

        _service('menu.admin.secondary')
            ->load('admin.core.mail');

        _service('menu.admin.buttons')
            ->load('admin.core.mail.buttons');
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'core_mail',
        ]))->process();
    }

    public function actionIndex()
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminManageEntryProcess([
            'noLimit'  => true,
            'select'   => $select,
            'data'     => ['defaultValue' => _param('core.default_mailer_id')],
            'template' => 'core/admin-mail/manage-mail-adapter',
        ]))->process();
    }

    public function actionAdd()
    {
        $request = _service('request');
        $driverName = $request->get('driver_id');

        if (!$driverName) {
            return new ViewModel([
                'form' => new SelectCoreDriver(['driverType' => self::DRIVER_TYPE]),
            ], 'layout/form-edit');
        }

        _redirect('admin.core.mail.adapter', ['action' => 'config', 'driver_id' => $driverName]);

    }

    public function actionConfig()
    {
        $request = _service('request');
        $driverId = $request->get('driver_id', 'local');

        $form = _service('core.adapter')
            ->getEditingForm($driverId, self::DRIVER_TYPE);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = _model('core_adapter')
                ->create([
                    'driver_id'   => $driverId,
                    'is_active'   => 0,
                    'driver_type' => self::DRIVER_TYPE,
                ]);

            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.mail.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $adapterId = $request->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = _model('core_adapter')->findById($adapterId);

        $form = _service('core.adapter')
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
            _redirect('admin.core.mail.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionTest()
    {
        $req = _service('request');
        $adapterId = $req->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = _model('core_adapter')->findById($adapterId);

        $form = new TestEmailSettings([]);

        if ($req->isGet()) {
            $data = _param('test_mail');
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

            list($result, $message) = _service('mailer')
                ->test($adapterEntry->getDriverId(), $params, $testEmail);

            if (!$result) {
                return '<pre>' . $message . '</pre>';
            } else {
                return '<p class="alert alert-success">Send mail successfully.</p>';
            }
        }

        return new ViewModel(['form' => $form], 'layout/form-edit');
    }

    /**
     * Set default adapter id
     * todo implement this method
     */
    public function actionDefault()
    {
        $request = _service('request');
        $identity = $request->get('adapter_id');

        /** @var CoreAdapter $entry */
        $entry = _model('core_adapter')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "adapter_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(true);
            $entry->save();
        }

        _service('core.setting')->updateValue('core.default_mailer_id', $identity);

        _service('cache.local')->flush();

        _redirect('admin.core.mail.adapter');
    }
}