<?php

namespace Neutron\Core\Block;

use Phpfox\Form\Form;
use Phpfox\View\Component;
use Phpfox\View\ViewModel;

class AdminFilter extends Component
{
    public function run()
    {
        $form = \Phpfox::get('context')
            ->get('filter.form');

        if (!$form instanceof Form) {
            return false;
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-filter');
    }
}