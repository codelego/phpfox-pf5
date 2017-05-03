<?php

namespace Neutron\Core\Block;

use Phpfox\Layout\LayoutComponent;
use Phpfox\View\ViewModel;

class ActionContent extends LayoutComponent
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