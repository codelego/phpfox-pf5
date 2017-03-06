<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\AjaxController;
use Phpfox\View\ViewModel;

class AjaxI18nController extends AjaxController
{
    public function actionSave()
    {
        $request = \Phpfox::get('request');
        $key = $request->get('text_key');
        $value = $request->get('text_value');
        $lang = $request->get('text_lang', '');
        $dm = $request->get('text_domain');
        $cmd = $request->get('cmd');


        if ($cmd == 'delete') {
            \Phpfox::with('i18n_message')
                ->delete(['var_name' => $key]);
        }

        $vm = new ViewModel([
            'message' => _text('Change Saved!'),
            'cmd'     => $cmd,
            'item'    => [
                'name'   => $key,
                'value'  => $value,
                'lang'   => $lang,
                'domain' => $dm,
            ],
        ]);

        return $vm;
    }
}