<?php

namespace Phpfox\Navigation;


class NavbarNavDecorator implements NavigationDecoratorInterface
{
    use NavigationDecoratorTrait;

    protected $items = [];

    public function render()
    {
        /** @var NavigationLoaderInterface $loader */
        $loader = \Phpfox::get('navigation.loader');
        $this->data = $loader->load($this->menu, $this->section);
    }

    /**
     * @var array
     */
    protected $defaults
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

    /**
     * @inheritdoc
     */
    public function _render()
    {
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

        if (count($content) > $this->defaults['max']) {
            // re-process content for the level of now and how to process it as the main feature
        }

        $class = $this->defaults['level0'];

        return '<ul class="' . $class . '">' . implode('', $content) . '</ul>';
    }

    /**
     * prepare items
     */
    public function prepareItems()
    {
        foreach ($this->items as $offset => $item) {
            if ($item['acl']) {
                if (false == \app()->acl()->authorize(null, $item['acl'])) {
                    unset($this->items[$offset]);
                    continue;
                }
            }

            if ($item['type'] == 'event') {
                if (false == ($item = \app()->callback($item['event'],
                        $item))
                ) {
                    unset($this->items[$offset]);
                } else {
                    $this->items[$offset] = $item;
                }
            }
        }

        $this->items = array_values($this->items);

        if ($this->level == 1 && count($this->items) > $this->defaults['max']) {
            // rebuild items by the next
            $items = array_slice($this->items, 0, $this->defaults['max'] - 1);

            $items[] = [
                'name'     => 'more',
                'label'    => $this->defaults['moreLabel'],
                'type'     => 'static',
                'href'     => '#',
                'acl'      => '',
                'active'   => 0,
                'children' => [
                    'level' => 1,
                    'items' => array_slice($this->items,
                        $this->defaults['max'] - 1),
                ],
            ];
            $this->items = $items;
        }
    }

    /**
     *
     */
    public function prepareActiveItems()
    {
        foreach ($this->items as $index => $item) {
            if (in_array($item['name'], $this->active)) {
                $this->items[$index]['active'] = 1;
            }
            if (!empty($item['children'])) {
                foreach ($item['children']['items'] as $sub => $cat) {
                    if (in_array($cat['name'], $this->active)) {
                        $this->items[$index]['children']['items'][$sub]['active']
                            = 1;
                    }
                }
            }
        }
    }

    /**
     * @param int   $level
     * @param array $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        if (is_string($item)) {
            return $item;
        }

        $href = null;

        $params = [];
        if (!empty($item['params'])) {
            $params = $item['params'];
            foreach ($params as $k => $v) {
                if (substr($v, 0, 1) == '$') {
                    $params[$k] = \app()->requester()->getParam(substr($v, 1));
                }
            }
        }

        if ($item['type'] == 'separator') {
            return '<li class="divider"></li>';
        } else {
            if ($item['type'] == 'route') {
                $item['href'] = \app()->routing()
                    ->getUrl($item['route'], $params);
            }
        }

        if (is_string($item)) {
            return $item;
        }

        if (empty($item['href'])) {
            if (!empty($item['route'])) {
                $href = \app()->routing()->getUrl($item['route'], $params);
            }
        } else {
            $href = $item['href'];
        }

        $label = _text('nav', $item['label']);

        // process plugin but return false.
        if (!$item) {
            return '';
        }

        $extra = '';
        $cls = 'ni-' . $item['name'];

        if (!empty($item['class'])) {
            $cls = $item['class'];
        }

        if ($item['active']) {
            $cls .= ' active';
        }

        if (!empty($item['extra'])) {
            $extra = _attrize($item['extra']);
        }

        if (!empty($item['children']) && $level < $this->level) {
            $childrenHtml = $this->renderChildren($item['children']['level'],
                $item['children']['items']);

            return '<li class="dropdown ' . $cls . '">'
                . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'
                . $label . $this->defaults['dropdownIcon'] . '</a>'
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
        if (empty($items)) {
            return '';
        }

        $content = [];

        foreach ($items as $item) {
            $content[] = $this->renderItem($level, $item);
        }

        $suffix = '';
        if ($level == 1) {
//            $suffix = '<li class="tail"><div></div></li>';
        }

        $class = $this->defaults[sprintf('level%d', $level)];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content)
            . $suffix . '</ul>';
    }
}