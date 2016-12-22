<?php

namespace Neutron\Pages\Service;


class ProfileNameFilter
{
    /**
     * @param array $params
     *
     * @return bool
     */
    public function onMatch(&$params)
    {
        $id = isset($params['name']) ? $params['name'] : null;


        // is digit
        $item = \Phpfox::get('pages.browse')->findById($id);

        if (!$item) {
            return false;
        }

        $params['controller'] = 'pages.profile';

        return true;
    }

    public function onCompile(&$params)
    {
        if ($params) {
            ;
        }
        return true;
    }
}