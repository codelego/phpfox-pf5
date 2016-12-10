<?php
namespace Neutron\Pages;

class Callback
{

    /**
     * @param array $params
     *
     * @return bool
     */
    public function checkProfileId(&$params)
    {
        $id = isset($params['name']) ? $params['name'] : null;

        $item = \Phpfox::findById('pages', $id);

        if (!$item) {
            return false;
        }

        $params['controller'] = 'pages.profile';

        return true;
    }

    function __call($name, $arguments)
    {
        // do nothings
    }
}