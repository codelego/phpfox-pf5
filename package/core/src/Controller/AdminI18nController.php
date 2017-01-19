<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddNewPhrase;
use Neutron\Core\Form\FilterI18nPhrase;
use Phpfox\View\ViewModel;

class AdminI18nController extends AdminController
{
    public function actionLanguages()
    {

    }

    public function actionIndex()
    {
        $items = \Phpfox::getModel('i18n_language')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel(['items' => $items]);

        $vm->setTemplate('core.admin-i18n.index');

        return $vm;
    }

    public function actionAddPhrase()
    {
        $vm = new ViewModel();

        $form = new AddNewPhrase();

        $vm->assign(['form'=>$form,'heading'=>'Add New Phrase',]);

        $vm->setTemplate('layout.admin-edit');

        return $vm;

    }

    public function actionPhrases()
    {

        $form = new FilterI18nPhrase([]);

        \Phpfox::get('require_js')
            ->deps('package/core/admin-i18n');


        $items = \Phpfox::getModel('i18n_phrase')
            ->select()
            ->limit(100, 0)
            ->execute()
            ->all();

        $vm = new ViewModel(['items' => $items, 'form' => $form]);

        $vm->setTemplate('core.admin-i18n.phrases');

        return $vm;
    }
}