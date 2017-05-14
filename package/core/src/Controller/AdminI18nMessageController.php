<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\I18nMessage\AddI18nMessage;
use Neutron\Core\Form\Admin\I18nMessage\FilterI18nMessage;
use Neutron\Core\Form\Admin\I18nTimezone\EditI18nTimezone;
use Neutron\Core\Model\I18nMessage;
use Neutron\Core\Model\I18nTimezone;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;
use Phpfox\View\ViewModel;

class AdminI18nMessageController extends AdminController
{

    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('International', 'admin'));

        _get('menu.admin.secondary')->load('admin.core.i18n');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('admin.core.i18n.message.buttons');
        }
    }

    public function actionIndex()
    {
        _get('require_js')
            ->deps('package/core/admin-i18n');

        return (new AdminManageEntryProcess([
            'filter'   => FilterI18nMessage::class,
            'model'    => I18nMessage::class,
            'template' => 'core/admin-i18n/manage-i18n-message',
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'timezone_id',
            'model'    => I18nTimezone::class,
            'form'     => EditI18nTimezone::class,
            'redirect' => _url('admin.core.i18n.timezone'),
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