<?php

namespace Neutron\Core\Block;

use Phpfox\View\Component;
use Phpfox\View\ViewModel;

class ActionContent extends Component
{
    public function run()
    {
        $data = \Phpfox::get('response')->getData();

        if (is_string($data)) {
            return $data;
        }

        if ($data instanceof ViewModel) {
            return $data->render();
        }

        return '';
    }
}