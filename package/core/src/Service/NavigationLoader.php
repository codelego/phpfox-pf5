<?php

namespace Neutron\Core\Service;


use Phpfox\Navigation\NavigationLoaderInterface;

class NavigationLoader implements NavigationLoaderInterface
{
    CONST MAX_LEVEL = 4;

    public function loadFromRepository($menu)
    {
        $select = _get('db')
            ->select('*')
            ->from(':core_menu')
            ->where('menu=?', trim($menu))
            ->where('is_active=?', 1)
            ->order('sort_order', 1);

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
     * @param string $parentId
     *
     * @return array
     */
    public function load($menu, $parentId = null)
    {
        return $this->loadFromRepository($menu);
    }
}