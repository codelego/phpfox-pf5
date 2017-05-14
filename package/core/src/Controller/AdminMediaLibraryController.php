<?php

namespace Neutron\Core\Controller;

class AdminMediaLibraryController extends AdminController
{
    /**
     * @route admin.core.media-library
     */
    public function actionIndex()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('Mail Settings', 'admin'));

    }
}