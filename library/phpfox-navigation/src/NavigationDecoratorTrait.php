<?php

namespace Phpfox\Navigation;


trait NavigationDecoratorTrait
{
    /**
     * @var array
     */
    protected $data;

    /**
     * render from section
     *
     * @var string
     */
    protected $section;

    /**
     * Menu name
     *
     * @var string
     */
    protected $menu;

    /**
     * List of active items
     *
     * @var array|string
     */
    protected $active;

    /**
     * max number to render
     *
     * @var number
     */
    protected $level;

    /**
     * @var array
     */
    protected $context;


    public function __construct(
        $menu,
        $parentId,
        $active,
        $level,
        $context
    ) {

        $this->menu = $menu;
        $this->section = $parentId;
        $this->active = $active;
        $this->level = $level;
        $this->context = $context;

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