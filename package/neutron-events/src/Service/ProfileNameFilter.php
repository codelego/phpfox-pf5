<?php

namespace Neutron\Event\Service;


class ProfileNameFilter
{
    public function onMatch(&$params)
    {
        if ($params) {
            ;
        }
        return false;
    }

    public function onCompile(&$params)
    {
        if ($params) {
            ;
        }
        return false;
    }
}