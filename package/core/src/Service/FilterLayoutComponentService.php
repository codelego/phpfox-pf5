<?php

namespace Neutron\Core\Service;

use Phpfox\Support\FilterInterface;

class FilterLayoutComponentService implements FilterInterface
{
    public function filter($criteria)
    {
        $select = _model('layout_component')->select();



        return $select;
    }
}