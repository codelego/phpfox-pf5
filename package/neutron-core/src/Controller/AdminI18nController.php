<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\FilterI18nPhrase;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminI18nController extends ActionController
{
    public function actionIndex()
    {
        $items = \Phpfox::getModel('i18n_language')
            ->select()
            ->execute()
            ->all();

        return new ViewModel('core.admin-i18n.index', ['items' => $items]);
    }

    public function actionBrowsePhrase()
    {
        $form = new FilterI18nPhrase([]);

        $items = \Phpfox::getModel('i18n_phrase')
            ->select()
            ->limit(100, 0)
            ->execute()
            ->all();

        return new ViewModel('core.admin-i18n.browse-phrase',
            ['items' => $items, 'form' => $form]);
    }
}