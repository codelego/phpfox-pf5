<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\I18nMessage\AddI18nMessage;
use Neutron\Core\Form\Admin\I18nMessage\FilterI18nMessage;
use Neutron\Core\Form\Admin\I18nTimezone\EditI18nTimezone;
use Neutron\Core\Model\I18nMessage;
use Neutron\Core\Model\I18nTimezone;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Core\Service\FilterI18nMessageService;
use Phpfox\View\ViewModel;

class AdminI18nMessageController extends AdminController
{

    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('International', 'admin'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'i18n');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            \Phpfox::get('menu.admin.buttons')->load('_core.i18n.message.buttons');
        }
    }

    public function actionIndex()
    {
        \Phpfox::get('require_js')
            ->deps('package/core/admin-i18n');

        return (new AdminListEntryProcess([
            'filter.form'    => FilterI18nMessage::class,
            'filter.service' => new FilterI18nMessageService(),
            'model'          => I18nMessage::class,
            'template'       => 'core/admin-i18n/manage-message',
        ]))->process();
    }

    public function actionSave()
    {
        $req = \Phpfox::get('request');
        $identity = $req->get('message_id');
        /** @var I18nMessage $entry */
        $entry = \Phpfox::find('i18n_message', $identity);
        $entry->setMessageValue($req->get('message_value'));
        $entry->save();

        return ['value' => $entry->getMessageValue(), 'message' => 'Successful'];
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'message_id',
            'model'    => I18nTimezone::class,
            'form'     => EditI18nTimezone::class,
            'redirect' => _url('admin.core.i18n.message'),
        ]))->process();
    }

    public function actionAdd()
    {
        $form = new AddI18nMessage();

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}