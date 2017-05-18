<?php

namespace Neutron\Core\Service;


use Phpfox\Navigation\NavigationLoaderInterface;

class NavigationLoader implements NavigationLoaderInterface
{

    public function _getNavigationParameter($menu)
    {
        $select = _get('db')
            ->select('*')
            ->from(':core_menu')
            ->where('menu=?', trim($menu))
            ->where('package_id in ?', _get('core.packages')->getIds())
            ->where('is_active=?', 1)
            ->order('ordering', 1);

        return array_map(function ($row) {
            $row['params'] = (array)json_decode($row['params'], 1);
            $row['extra'] = (array)json_decode($row['extra'], 1);
            return $row;
        }, $select->all());

    }

    /**
     * Make navigation data to tree data structure
     *
     * @param string $menu
     *
     * @return array
     */
    public function getNavigationParameter($menu)
    {
        return $this->_getNavigationParameter($menu);
    }
}