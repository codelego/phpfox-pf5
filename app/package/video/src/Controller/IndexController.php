<?php

namespace Neutron\Video\Controller;

use Neutron\Video\Form\EmbedVideo;
use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        $items = \Phpfox::model('video')
            ->select()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'video/index/index');
    }

    public function actionEmbed()
    {
        $form = new EmbedVideo();

        return new ViewModel([
            'form' => $form,
        ], 'video/index/embed');
    }
}