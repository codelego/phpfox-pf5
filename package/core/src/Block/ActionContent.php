<?php

namespace Neutron\Core\Block;

use Phpfox\Layout\Component;
use Phpfox\View\ViewModel;

class ActionContent extends Component
{
    public function run()
    {
        $data = _service('response')->getData();

        if (is_string($data)) {
            return $data;
        }

        if ($data instanceof ViewModel) {
            return $data->render();
        }

        return '';
    }
}