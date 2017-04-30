<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddNewPhrase;
use Neutron\Core\Form\FilterI18nPhrase;
use Phpfox\View\ViewModel;

class AdminI18nController extends AdminController
{
    public function actionIndex()
    {
        $items = \Phpfox::with('i18n_language')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-i18n/index');
    }

    public function actionLanguages()
    {
        $this->forward(null, 'index');
    }

    public function actionAddPhrase()
    {
        $form = new AddNewPhrase();

        return new ViewModel([
            'form'    => $form,
            'heading' => 'Add New Phrase',
        ], 'layout/form-edit');
    }

    public function actionPhrases()
    {
        $form = new FilterI18nPhrase([]);

        \Phpfox::get('require_js')
            ->deps('package/core/admin-i18n');

        $items = \Phpfox::with('i18n_message')
            ->select()
            ->limit(100, 0)
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
            'form'  => $form,
        ], 'core/admin-i18n/phrases');

    }
}