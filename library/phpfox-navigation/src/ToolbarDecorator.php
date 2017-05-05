<?php

namespace Phpfox\Navigation;

class ToolbarDecorator implements DecoratorInterface
{
    /**
     * max number to render
     *
     * @var number
     */
    private $level = 4;

    /**
     * @var array
     */
    private $defaults
        = [
            'level0' => 'btn-group',
            'level1' => '',
            'level2' => '',
            'level3' => '',
            'level4' => '',

        ];

    private $context = [];

    public function render(Navigation $navigation, $context = [])
    {
        $this->context = array_merge($this->defaults, $context);
        $content = [];

        foreach ($navigation->items as $item) {
            try {
                $content[] = $this->renderItem(0, $item);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }
        $topClass = $this->context['level0'];
        return '<div class="' . $topClass . '">' . implode('', $content)
            . '</div>';
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
                    $params[$k] = _service('request')
                        ->get(substr($v,
                            1));
                }
            }
        }

        if ($item->type == 'separator') {
            return '<li class="divider"></li>';
        } else {
            if ($item->href != '') {
                $href = $item->href;
            } elseif ($item->type == 'plugin') {
                $item = _callback($item->event, $params);
            } elseif ($item->route) {
                $href = _url($item->route, $params);
            }
        }

        $label = _text($item->label, 'menu');

        // process plugin but return false.
        if (!$item) {
            return '';
        }

        $cls = 'mi-' . $item->name;

        if (!empty($item->class)) {
            $cls = $item->class;
        }

        if ($item->active) {
            $cls .= ' active';
        }

        $extra = _attrize($item->get('extra', ['class' => 'btn btn-default']));

        if (!empty($item->children)) {
            $childrenHtml = $this->renderChildren($level + 1, $item->children);

            return '<li class="dropdown">'
                . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'
                . $label . '<span class="caret"></span></a>' . $childrenHtml
                . '</li>';
        } else {
            return '<a ' . $extra . ' href="' . $href
                . '">' . $label . '</a>';
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