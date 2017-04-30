<?php

namespace Neutron\Core\Block;

use Phpfox\Layout\LayoutBlock;
use Phpfox\View\ViewModel;

class ActionContent extends LayoutBlock
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
    }
}