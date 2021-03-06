<?php

namespace Neutron\Core\Controller;

use Phpfox\Kernel\AjaxController;
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
            \Phpfox::model('i18n_message')
                ->delete(['var_name' => $key]);
        }

        return new ViewModel([
            'message' => _text('Change Saved!'),
            'cmd'     => $cmd,
            'item'    => [
                'name'   => $key,
                'value'  => $value,
                'lang'   => $lang,
                'domain' => $dm,
            ],
        ]);
    }
}