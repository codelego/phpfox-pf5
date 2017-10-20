<?php

namespace Neutron\Quiz\Controller;


use Neutron\Core\Controller\AdminController;

class AdminQuizController extends AdminController
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
}