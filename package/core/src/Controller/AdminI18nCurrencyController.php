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
        _service('html.title')
            ->set(_text('International', 'admin'));

        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _service('menu.admin.secondary')->load('admin.core.i18n');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')->load('admin.core.i18n.currency.buttons');
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
        $identity = _service('request')
            ->get('currency_id');

        /** @var I18nCurrency $entry */
        $entry = _model('i18n_currency')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "currency_id"');
        }

        if(!$entry->isActive()){
            $entry->setActive(1);
            $entry->save();
        }

        _service('core.setting')->updateValue('core.default_currency_id', $identity);

        _service('cache.local')->flush();

        _redirect('admin.core.i18n.currency');
    }
}