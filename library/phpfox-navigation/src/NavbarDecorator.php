<?php

namespace Phpfox\Navigation;


class NavbarDecorator extends AbstractDecorator
{
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

    public function render(Navigation $navigation)
    {
        $content = [];
        foreach ($navigation->items as $item) {
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

    /**
     * @param int            $level
     * @param NavigationItem $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        $href = null;
        $params = $item->params;

        // validate passed acl
        if ($item->acl and !_pass(null, $item->acl)) {
            return '';
        }

        if (!empty($params)) {
            foreach ($params as $k => $v) {
                if (substr($v, 0, 1) == '$') {
                    $params[$k] = _get('request')->get(substr($v, 1));
                }
            }
        }

        if ($item->type == 'separator') {
            return '<li class="divider"></li>';
        } elseif ($item->type == 'route') {
            $href = _url($item->route, $params);
        }

        if ($href) {
            if (!empty($item->route)) {
                $href = _url($item->route, $params);
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
        $cls = 'mi-' . $item->name;

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