<?php

namespace Phpfox\Navigation;

class TabNavDecorator
{
    use NavigationDecoratorTrait;

    protected $items;

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
     * @param int   $level
     * @param array $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        if ($level) {
            ;
        }

        if ($item['acl']) {
            if (false == \Phpfox::getAcl()->hasPermission(null, $item['acl'])) {
                return '';
            }
        }

        $href = null;
        $params = [];
        if (!empty($item['params'])) {
            $params = $item['params'];
            foreach ($params as $k => $v) {
                if (substr($v, 0, 1) == '$') {
                    $params[$k] = \Phpfox::mvcRequest()->getParam(substr($v,
                        1));
                }
            }
        }

        if ($item['type'] == 'separator') {
            return '<li class="divider"></li>';
        } else {
            if ($item['type'] == 'route') {
                $href = \Phpfox::router()->getUrl($item['route'], $params);
            } else {
                if ($item['type'] == 'plugin') {
                    $item = \Phpfox::callback($item['event'], $params);
                }
            }
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

        if (!empty($item['children'])) {
            $childrenHtml = $this->renderChildren($item['children']['level'],
                $item['children']['items']);

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
        foreach ($this->items as $index => $item) {
            if (in_array($item['name'], $this->active)) {
                $this->items[$index]['active'] = 1;
            }
            if (!empty($item['children'])) {
                foreach ($item['children'] as $sub => $cat) {
                    if (!empty($cat['name']) and in_array($cat['name'],
                            $this->active)
                    ) {
                        $this->items[$index]['children'][$sub]['active'] = 1;
                    }
                }
            }
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

        $class = $this->params[sprintf('level%d', $level)];

        return '<ul class="' . $class . '" role="menu">' . implode('', $content)
            . '</ul>';
    }
}