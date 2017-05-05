<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddNewPhrase;
use Neutron\Core\Form\FilterI18nPhrase;
use Phpfox\View\ViewModel;

class AdminI18nPhraseController extends AdminController
{

    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('Translations', 'admin'),
            ]);

        _service('html.title')
            ->clear()
            ->set(_text('Translation', 'admin'));

        _service('menu.admin.secondary')->load('admin.core.i18n');


    }


    public function actionAdd()
    {
        $form = new AddNewPhrase();

        return new ViewModel([
            'form'    => $form,
            'heading' => 'Add New Phrase',
        ], 'layout/form-edit');
    }

    public function actionIndex()
    {
        $filter = new FilterI18nPhrase([]);

        _service('registry')
            ->set('search.filter', $filter);

        _service('require_js')
            ->deps('package/core/admin-i18n');

        $items = _model('i18n_message')
            ->select()
            ->limit(100, 0)
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-i18n/manage-phrase');

    }
}