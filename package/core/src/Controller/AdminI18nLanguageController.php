<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\I18nLanguage\AddI18nLanguage;
use Neutron\Core\Form\Admin\I18nLanguage\EditI18nLanguage;
use Neutron\Core\Model\I18nLanguage;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminI18nLanguageController extends AdminController
{

    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _service('html.title')
            ->clear()
            ->set(_text('International', 'admin'));

        _service('menu.admin.secondary')->load('admin.core.i18n');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')->load('admin.core.i18n.language.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'model'    => I18nLanguage::class,
            'template' => 'core/admin-i18n/manage-i18n-language',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'       => I18nLanguage::class,
            'form'        => AddI18nLanguage::class,
            'redirection' => _url('admin.core.i18n.language'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'         => 'language_id',
            'model'       => I18nLanguage::class,
            'form'        => EditI18nLanguage::class,
            'redirection' => _url('admin.core.i18n.language'),
        ]))->process();
    }

    public function actionDelete()
    {

    }
}