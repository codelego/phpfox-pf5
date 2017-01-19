<?php

namespace Phpfox\Navigation;

class NavDecorator
{
    protected $max_level = 3;
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
        $section,
        $active,
        $level,
        $context
    ) {

        $this->menu = $menu;
        $this->section = $section;
        $this->active = $active;
        $this->level = $level;
        $this->context = $context;

    }

    /**
     * @var NavigationItem[]
     */
    protected $items = [];

    /**
     * @var array
     */
    protected $params
        = [
            'level0' => 'nav nav-tabs',
            'level1' => '',
            'level2' => '',
            'level3' => '',
            'level4' => '',

        ];

    /**
     * @inheritdoc
     */
    public function render()
    {

        $this->items = \Phpfox::get('navigation.loader')->load($this->menu);

        if (empty($this->items)) {
            return '';
        }

        $this->prepareActiveItems();

        $content = [];

        foreach ($this->items as $item) {
            try {
                $content[] = $this->renderItem(0, $item);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        $topClass = $this->params['level0'];

        return '<ul class="' . $topClass . '">' . implode('', $content)
            . '</ul>';
    }

    /**
     * @param int            $level
     * @param NavigationItem $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        if ($level) {
            ;
        }

        if ($item->acl and !_pass($item->acl)) {
            return '';
        }

        $href = null;
        $params = [];
        if (!empty($item->params)) {
            $params = $item['params'];
            foreach ($params as $k => $v) {
                if (substr($v, 0, 1) == '$') {
                    $params[$k] = \Phpfox::get('mvc.request')
                        ->get(substr($v,
                            1));
                }
            }
        }

        if ($item->type == 'separator') {
            return '<li class="divider"></li>';
        } else {
            if ($item->type == 'route') {
                $href = \Phpfox::router()->getUrl($item->route, $params);
            } else {
                if ($item->type == 'plugin') {
                    $item = \Phpfox::callback($item->event, $params);
                }
            }
        }

        $label = _text($item->label, 'menu');

        // process plugin but return false.
        if (!$item) {
            return '';
        }

        $extra = '';
        $cls = 'ni-' . $item->name;

        if (!empty($item->class)) {
            $cls = $item->class;
        }

        if ($item->active) {
            $cls .= ' active';
        }

        if (!empty($item->extra)) {
            $extra = _attrize($item['extra']);
        }

        if (!empty($item->children)) {
            $childrenHtml = $this->renderChildren($level + 1, $item->children);

            return '<li class="dropdown">'
                . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'
                . $label . '<span class="caret"></span></a>' . $childrenHtml
                . '</li>';
        } else {
            return '<li role="presentation" class="' . $cls . '"><a ' . $extra
                . ' href="' . $href . '">' . $label . '</a></li>';
        }

    }

    /**
     *
     */
    public function prepareActiveItems()
    {

    }

    /**
     * @param int   $level
     * @param array $items
     *
     * @return string
     */
    public function renderChildren($level, $items)
    {
        $content = [];

        foreach ($items as $item) {
            $content[] = $this->renderItem($level, $item);
        }

        $class = $this->params[sprintf('level%d', $level)];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content)
            . '</ul>';
    }
}