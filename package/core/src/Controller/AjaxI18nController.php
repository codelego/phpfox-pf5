<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\AjaxController;

class AjaxI18nController extends AjaxController
{
    public function actionSave()
    {
        $request = \Phpfox::get('mvc.request');
        $key = $request->get('text_key');
        $value = $request->get('text_value');
        $lang = $request->get('text_lang', '');
        $dm = $request->get('text_domain');
        $cmd = $request->get('cmd');


        if ($cmd == 'delete') {
            \Phpfox::getModel('i18n_phrase')
                ->sqlDelete()
                ->where('var_name=?', $key)
                ->execute();
        }

        return [
            'message' => _text('Change Saved!'),
            'cmd'     => $cmd,
            'item'    => [
                'name'   => $key,
                'value'  => $value,
                'lang'   => $lang,
                'domain' => $dm,
            ],
        ];
    }
}