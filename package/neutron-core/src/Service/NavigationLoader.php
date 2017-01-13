<?php

namespace Neutron\Core\Service;


use Phpfox\Navigation\NavigationItem;
use Phpfox\Navigation\NavigationLoaderInterface;

class NavigationLoader implements NavigationLoaderInterface
{
    CONST MAX_LEVEL = 4;

    public function loadFromRepository($menu)
    {
        return \Phpfox::db()->select('*')
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
        $items = [];
        $rows = [];

        $temp = $this->loadFromRepository($menu);

        // prepare item data
        foreach ($temp as $row) {
            $rows[$row['name']] = new NavigationItem($row);
        }

        for ($level = self::MAX_LEVEL; $level > 0; --$level) {
            foreach ($rows as $index => $row) {
                if (empty($row)) {
                    continue;
                }

                $isValid = true;
                $parent = $row->parent_name;

                if ($parent == $parentId) {
                    continue;
                }
                $nextParent = $parent;

                for ($i = 0; $i < $level && $isValid; ++$i) {
                    if ($nextParent == $parentId) {
                        if ($i < $level - 1) {
                            $isValid = false;
                        }
                        continue;
                    }

                    if (!isset($rows[$nextParent])) {
                        $isValid = false;
                    } else {
                        $nextParent = $rows[$nextParent]->parent_name;
                    }
                }
                if ($isValid && $nextParent == $parentId && $i == $level) {
//                    $rows[$parent]['children']['level'] = $level - 1;
                    $rows[$parent]->children[] = $row;
                    unset($rows[$index]);
                }
            }
        }

        foreach ($rows as $index => $row) {
            if (!empty($row) && $row->parent == $parentId) {
                $items[$row->name] = $row;
            }
        }

        return $items;
    }
}