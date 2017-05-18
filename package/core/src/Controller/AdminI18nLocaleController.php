<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\I18nLocale\AddI18nLocale;
use Neutron\Core\Form\Admin\I18nLocale\EditI18nLocale;
use Neutron\Core\Model\I18nLocale;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminI18nLocaleController extends AdminController
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

        _get('menu.admin.secondary')
            ->load('_core.i18n');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')
                ->load('_core.i18n.locale.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => I18nLocale::class,
            'data'     => ['defaultValue' => _param('core.default_locale_id')],
            'template' => 'core/admin-i18n/manage-i18n-locale',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'       => I18nLocale::class,
            'form'        => AddI18nLocale::class,
            'redirection' => _url('admin.core.i18n.locale'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'locale_id',
            'model'    => I18nLocale::class,
            'form'     => EditI18nLocale::class,
            'redirect' => _url('admin.core.i18n.locale'),
        ]))->process();
    }

    public function actionDelete()
    {

    }

    public function actionDefault()
    {
        $identity = _get('request')
            ->get('locale_id');

        /** @var I18nLocale $entry */
        $entry = _model('i18n_locale')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "locale_id"');
        }

        if (!$entry->isDefault()) {
            _model('i18n_locale')
                ->update()
                ->values(['is_default' => 0])
                ->where('locale_id <> ?', $identity)
                ->execute();


            $entry->setDefault(1);
            $entry->setActive(1);
            $entry->save();
            _get('core.setting')->updateValue('core.default_locale_id', $identity);
        }
        _redirect('admin.core.i18n.locale');
    }
}