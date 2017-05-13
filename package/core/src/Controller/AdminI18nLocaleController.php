<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\I18nLocale\AddI18nLocale;
use Neutron\Core\Form\Admin\I18nLocale\EditI18nLocale;
use Neutron\Core\Model\I18nLocale;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminI18nLocaleController extends AdminController
{

    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _service('html.title')
            ->set(_text('International', 'admin'));

        _service('menu.admin.secondary')
            ->load('admin.core.i18n');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')
                ->load('admin.core.i18n.locale.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
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
        $identity = _service('request')
            ->get('locale_id');

        /** @var I18nLocale $entry */
        $entry = _model('i18n_locale')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "locale_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(1);
            $entry->save();
        }

        _service('core.setting')->updateValue('core.default_locale_id', $identity);

        _service('cache.local')->flush();

        _redirect('admin.core.i18n.locale');
    }
}