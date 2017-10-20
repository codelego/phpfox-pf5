<?php

namespace Neutron\Quiz\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Quizzes'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.quiz'), 'label' => _text('Quizzes')]);

        _get('menu.admin.buttons')->load('_quiz.buttons');
        _get('menu.admin.secondary')->load('admin', 'quiz');

    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'quiz',
        ]))->process();
    }
}