<?php

namespace Phpfox\Navigation;

class NavDecorator extends AbstractDecorator
{
    /**
     * @var array
     */
    protected $defaults
        = [
            'level0' => 'nav nav-tabs',
            'level1' => '',
            'level2' => '',
            'level3' => '',
            'level4' => '',

        ];

    public function render(Navigation $navigation)
    {
        $content = [];

        foreach ($navigation->items as $item) {
            try {
                $content[] = $this->renderItem(0, $item);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }
        $topClass = $this->context['level0'];
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

        if ($item->acl and !_pass(null, $item->acl)) {
            return '';
        }

        $href = null;
        $params = $item->params;
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                if (substr($v, 0, 1) == '$') {
                    $params[$k] = _get('request')->get(substr($v, 1));
                }
            }
        }

        if ($item->type == 'separator') {
            return '<li class="divider"></li>';
        } else {
            if ($item->type == 'route') {
                $href = _url($item->route, $params);
            } else {
                if ($item->type == 'plugin') {
                    $item = _callback($item->event, $params);
                }
            }
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

        $class = $this->context[sprintf('level%d', $level)];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content)
            . '</ul>';
    }
}