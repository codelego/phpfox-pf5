<?php

namespace Neutron\Pages\Service;

use Neutron\Pages\Model\Pages;

class Browse
{

    /**
     * @param  string $name
     *
     * @return Pages|mixed
     */
    public function findById($name)
    {
        $browse = \Phpfox::getModel('pages');
        $pages = null;

        if (substr($name, 0, 1) > '9') {
            $pages = $browse->select()
                ->where('profile_name=?', (string)$name)
                ->execute()
                ->first();
        } else {
            $pages = $browse->select()
                ->where('pages_id=?', (int)$name)
                ->execute()
                ->first();
        }

        return $pages;
    }
}