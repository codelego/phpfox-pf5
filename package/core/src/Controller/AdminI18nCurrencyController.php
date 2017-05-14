<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\I18nCurrency\AddI18nCurrency;
use Neutron\Core\Form\Admin\I18nCurrency\EditI18nCurrency;
use Neutron\Core\Model\I18nCurrency;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminI18nCurrencyController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('International', 'admin'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _get('menu.admin.secondary')->load('admin.core.i18n');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('admin.core.i18n.currency.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'model'    => I18nCurrency::class,
            'data'     => ['defaultValue' => _param('core.default_currency_id')],
            'template' => 'core/admin-i18n/manage-i18n-currency',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => I18nCurrency::class,
            'form'     => AddI18nCurrency::class,
            'redirect' => _url('admin.core.i18n.currency'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'currency_id',
            'model'    => I18nCurrency::class,
            'form'     => EditI18nCurrency::class,
            'redirect' => _url('admin.core.i18n.currency'),
        ]))->process();
    }

    public function actionDefault()
    {
        $identity = _get('request')
            ->get('currency_id');

        /** @var I18nCurrency $entry */
        $entry = _model('i18n_currency')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "currency_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(1);
            $entry->save();
        }

        _get('core.setting')->updateValue('core.default_currency_id', $identity);

        _get('cache.local')->flush();

        _redirect('admin.core.i18n.currency');
    }
}