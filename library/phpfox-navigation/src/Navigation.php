<?php

namespace Phpfox\Navigation;

class Navigation
{
    /**
     * DEFINE max level = 4
     */
    const MAX_LEVEL = 4;

    /**
     * @var string
     */
    protected $menu;

    /**
     * @var string
     */
    protected $parentId;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var NavigationItem []
     */
    public $items = [];

    /**
     * @var int
     */
    protected $index = 0;

    /**
     * Navigation constructor.
     *
     * @param null $menu
     * @param null $parentId
     *
     * @internal param $data
     */
    public function __construct($menu = null, $parentId = null)
    {
        $this->menu = $menu;
        $this->parentId = null;

        if ($this->menu) {
            $this->data = _service('navigation.loader')->load($menu);
        }
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param string $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param string $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Add to raw data
     *
     * @param $data
     *
     * @return $this
     */
    public function add($data)
    {
        ++$this->index;
        if (!isset($data['name'])) {
            $data['name'] = '_' . $this->index;
        }
        $this->data[$data['name']] = $data;

        return $this;
    }

    /**
     * Clear data
     *
     * @return $this
     */
    public function clear()
    {
        $this->data = [];
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    public function prepare()
    {
        $rows = [];
        $parentId = $this->parentId;
        $this->items = [];

        // prepare item data
        foreach ($this->data as $row) {
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
                    $rows[$parent]->children[] = $row;
                    unset($rows[$index]);
                }
            }
        }

        foreach ($rows as $index => $row) {
            if (!empty($row) && $row->parent == $parentId) {
                $this->items[$row->name] = $row;
            }
        }
    }

    /**
     * @param string $decorator
     * @param array  $context
     *
     * @return string
     */
    public function render($decorator, $context = [])
    {
        $this->prepare();

        if ($this->isEmpty()) {
            return '';
        }

        $class = _param('navigation.decorators', $decorator);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Navigation decorator '{$decorator}' does not exists.");
        }

        /** @var DecoratorInterface $decorate */
        $decorate = new $class;

        return $decorate->render($this, $context);
    }
}