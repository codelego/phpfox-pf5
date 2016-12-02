<?php

namespace Phpfox\Navigation;


class NavigationManager
{
    /**
     * define max level to load
     */
    CONST MAX_LEVEL = 4;

    /**
     * @param string $decorator
     * @param string $menu
     * @param string $parentId
     * @param array  $active
     * @param int    $level
     * @param array  $context
     *
     * @return string
     */
    public function render(
        $decorator,
        $menu,
        $parentId,
        $active = [],
        $level = 1,
        $context = []
    ) {
        $class = \Phpfox::getConfig('navigation.decorators', $decorator);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Navigation decorator '{$decorator}' does not exists.");
        }

        return (new \ReflectionClass($class))->newInstanceArgs(func_get_args())
            ->render();

    }


    /**
     * Make navigation data to tree data structure
     *
     * @param string $navigationId
     * @param string $parentId
     *
     * @return array
     */
    public function load($navigationId, $parentId = null)
    {
        $items = [];
        $rows = [];

        $temp = $this->loadFromRepository($navigationId, $parentId);

        // prepare item data
        foreach ($temp as $row) {
            $id = (int)$row->item_id;
            $name = $row->item_name;
            $params = (array)json_decode($row->params_text, true);
            $extra = (array)json_decode($row->extra_text, true);
            $module = (string)$row->module_id;
            $navId = (string)$row->nav_id;

            $rows[$name] = [
                'id'       => $id,
                'parent'   => (string)$row->parent_name,
                'name'     => $name,
                'navId'    => $navId,
                'acl'      => (string)$row->acl,
                'event'    => (string)$row->event,
                'module'   => $module,
                'label'    => $row->phrase_name,
                'type'     => (string)$row->item_type,
                'params'   => $params,
                'extra'    => $extra,
                'route'    => (string)$row->route,
                'children' => [],
                'active'   => 0,
            ];
        }

        for ($level = self::MAX_LEVEL; $level > 0; --$level) {
            foreach ($rows as $index => $row) {
                if (empty($row)) {
                    continue;
                }

                $isValid = true;
                $parent = $row['parent'];

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
                        $nextParent = $rows[$nextParent]['parent'];
                    }
                }
                if ($isValid && $nextParent == $parentId && $i == $level) {
                    $rows[$parent]['children']['level'] = $level - 1;
                    $rows[$parent]['children']['items'][$index] = $row;
                    unset($rows[$index]);
                }
            }
        }

        foreach ($rows as $index => $row) {
            if (!empty($row) && $row['parent'] == $parentId) {
                $items[$row['name']] = $row;
            }
        }

        return $items;
    }

    public function loadFromRepository($navigationId, $parentId)
    {
        if (!$navigationId) {
            ;
        }

        if (!$parentId) {
            ;
        }

        return [];
    }
}