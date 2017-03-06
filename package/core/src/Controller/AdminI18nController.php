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

        $vm = new ViewModel();
        $vm->assign(['items' => $items]);

        $vm->setTemplate('core/admin-i18n/index');

        return $vm;
    }

    public function actionLanguages()
    {
        $this->forward(null, 'index');
    }

    public function actionAddPhrase()
    {
        $vm = new ViewModel();

        $form = new AddNewPhrase();

        $vm->assign(['form' => $form, 'heading' => 'Add New Phrase',]);

        $vm->setTemplate('layout/form-edit');

        return $vm;
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

        $vm = new ViewModel();

        $vm->assign(['items' => $items, 'form' => $form]);

        $vm->setTemplate('core/admin-i18n/phrases');

        return $vm;
    }
}