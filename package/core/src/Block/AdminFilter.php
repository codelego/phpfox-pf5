<?php

namespace Neutron\Core\Block;


use Phpfox\Form\Form;
use Phpfox\Layout\Component;
use Phpfox\View\ViewModel;

class AdminFilter extends Component
{
    public function run()
    {
        $form = _service('registry')->get('search.filter');

        if (!$form instanceof Form) {
            return false;
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-filter');
    }
}