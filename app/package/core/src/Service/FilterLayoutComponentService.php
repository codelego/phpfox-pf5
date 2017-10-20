<?php

namespace Neutron\Core\Service;

use Phpfox\Kernel\FilterInterface;

class FilterLayoutComponentService implements FilterInterface
{
    public function filter($criteria)
    {
        $select = \Phpfox::model('layout_component')->select();


        return $select;
    }
}