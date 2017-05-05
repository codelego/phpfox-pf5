<?php

namespace Neutron\Pages\Service;

use Neutron\Pages\Model\Pages;

class Browse
{

    /**
     * @param  string $id
     *
     * @return Pages|mixed
     */
    public function findById($id)
    {
        $browse = _model('pages');
        $pages = null;

        if (substr($id, 0, 1) > '9') {

            $pages = $browse->select()
                ->where('profile_name=?', (string)$id)
                ->execute()
                ->first();
        } else {
            $pages = $browse->select()
                ->where('page_id=?', (int)$id)
                ->execute()
                ->first();
        }

        return $pages;
    }
}