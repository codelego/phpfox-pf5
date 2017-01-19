<?php

namespace Phpfox\Navigation;


class NavbarDecorator implements DecoratorInterface
{
    /**
     * render from section
     *
     * @var string
     */
    protected $section;

    /**
     * @var NavigationItem[]
     */
    protected $items = [];

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
    protected $context
        = [
            'level0'       => 'nav navbar-nav',
            'level1'       => 'dropdown-menu',
            'level2'       => '',
            'level3'       => '',
            'level4'       => '',
            'max'          => 12,
            'dropdownIcon' => '&nbsp;<span class="caret"></span>',
            'moreLabel'    => 'More',
        ];


    public function __construct(
        $menu,
        $section = null,
        $active = [],
        $level = 1,
        $context = []
    ) {

        $this->menu = $menu;
        $this->section = $section;
        $this->active = $active;
        $this->level = $level;
        $this->context = array_merge($this->context, $context);

    }


    public function render()
    {
        $this->items = \Phpfox::get('navigation.loader')->load($this->menu);

        if (empty($this->items)) {
            return '';
        }

        $this->prepareItems();
        $this->prepareActiveItems();

        $content = [];
        foreach ($this->items as $item) {
            try {
                $html = $this->renderItem(0, $item);
                if (!empty($html)) {
                    $content[] = $html;
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        if (count($content) > $this->context['max']) {
            // re-process content for the level of now and how to process it as the main feature
        }

        $class = $this->context['level0'];

        return '<ul class="' . $class . '">' . implode('', $content) . '</ul>';
    }

    public function prepareItems()
    {

    }

    public function prepareActiveItems()
    {

    }

    /**
     * @param int            $level
     * @param NavigationItem $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        $href = null;
        $params = [];

        // validate passed acl
        if ($item->acl and !_pass($item->acl)) {
            return '';
        }

        if (!empty($item->params)) {
            $params = $item->params;
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
        } elseif ($item->type == 'route') {
            $href = \Phpfox::router()
                ->getUrl($item->route, $params);
        }

        if ($href) {
            if (!empty($item->route)) {
                $href = \Phpfox::router()->getUrl($item->route, $params);
            }
        } else {
            $href = $item->href;
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
            $extra = _attrize($item->extra);
        }

        if (!empty($item->children) && $level < $this->level) {
            $childrenHtml = $this->renderChildren($level + 1, $item->children);

            return '<li class="dropdown ' . $cls . '">'
                . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'
                . $label . $this->context['dropdownIcon'] . '</a>'
                . $childrenHtml . '</li>';
        } else {
            return '<li class="' . $cls . '"><a ' . $extra . ' href="' . $href
                . '">' . $label . '</a></li>';
        }

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

        $suffix = '';
        if ($level == 1) {
//            $suffix = '<li class="tail"><div></div></li>';
        }

        $class = $this->context[sprintf('level%d', $level)];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content)
            . $suffix . '</ul>';
    }
}