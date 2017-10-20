<?php

namespace Neutron\Quiz\Controller;


use Neutron\Core\Controller\AdminController;

class AdminQuizController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Quizzes'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.quiz'), 'label' => _text('Quizzes')]);

        \Phpfox::get('menu.admin.buttons')->load('_quiz.buttons');
        \Phpfox::get('menu.admin.secondary')->load('admin', 'quiz');

    }
}