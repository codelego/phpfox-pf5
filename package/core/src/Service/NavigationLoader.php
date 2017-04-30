<?php

namespace Neutron\Core\Service;


use Phpfox\Navigation\Navigation;
use Phpfox\Navigation\NavigationLoaderInterface;

class NavigationLoader implements NavigationLoaderInterface
{
    CONST MAX_LEVEL = 4;

    public function loadFromRepository($menu)
    {
        return \Phpfox::db()
            ->select('*')
            ->from(':core_menu')
            ->where('menu=?', trim($menu))
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->execute()
            ->all();

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