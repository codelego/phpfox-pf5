<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\I18nCurrency\AddI18nCurrency;
use Neutron\Core\Form\Admin\I18nCurrency\EditI18nCurrency;
use Neutron\Core\Model\I18nCurrency;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminI18nCurrencyController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('International', 'admin'));

        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'i18n');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            \Phpfox::get('menu.admin.buttons')->load('_core.i18n.currency.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => I18nCurrency::class,
            'data'     => ['defaultValue' => \Phpfox::param('core.default_currency_id')],
            'template' => 'core/admin-i18n/manage-currency',
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
        $identity = \Phpfox::get('request')
            ->get('currency_id');

        /** @var I18nCurrency $entry */
        $entry = \Phpfox::model('i18n_currency')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "currency_id"');
        }

        if (!$entry->isDefault()) {
            \Phpfox::model('i18n_currency')
                ->update()
                ->values(['is_default' => 0])
                ->where('currency_id <> ?', $identity)
                ->execute();


            $entry->setDefault(1);
            $entry->setActive(1);
            $entry->save();
            \Phpfox::get('core.setting')->updateValue('core.default_currency_id', $identity);
        }
        \Phpfox::redirect('admin.core.i18n.currency');
    }
}