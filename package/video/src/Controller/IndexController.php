<?php

namespace Neutron\Video\Controller;

use Neutron\Video\Form\EmbedVideo;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {

        $vm = new ViewModel();

        $items = \Phpfox::with('video')
            ->select()
            ->all();


        $vm->setTemplate('video/index/index');
        $vm->assign(['items' => $items]);

        return $vm;
    }

    public function actionEmbed()
    {
        $form = new EmbedVideo();

        $vm = new ViewModel();
        $vm->assign(['form' => $form]);
        $vm->setTemplate('video/index/embed');

        return $vm;
    }
}