<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\I18nTimezone\AddI18nTimezone;
use Neutron\Core\Form\Admin\I18nTimezone\EditI18nTimezone;
use Neutron\Core\Model\I18nTimezone;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminI18nTimezoneController extends AdminController
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

        _get('menu.admin.secondary')->load('_core.i18n');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('_core.i18n.timezone.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'noLimit'  => true,
            'model'    => I18nTimezone::class,
            'data'     => ['defaultValue' => _param('core.default_timezone_id')],
            'template' => 'core/admin-i18n/manage-i18n-timezone',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => I18nTimezone::class,
            'form'     => AddI18nTimezone::class,
            'redirect' => _url('admin.core.i18n.timezone'),
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

    public function actionDefault()
    {
        $identity = _get('request')
            ->get('timezone_id');

        /** @var I18nTimezone $entry */
        $entry = _model('i18n_timezone')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "timezone_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(1);
            $entry->save();
        }

        _get('core.setting')->updateValue('core.default_timezone_id', $identity);

        _get('shared.cache')->flush();

        _redirect('admin.core.i18n.timezone');
    }
}