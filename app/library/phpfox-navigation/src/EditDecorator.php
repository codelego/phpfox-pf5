<?php

namespace Phpfox\Navigation;


class EditDecorator extends AbstractDecorator
{
    protected $level = 1;

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

        return '<ol class="' . $class . '" data-name="">' . implode('', $content) . '</ul>';
    }

    /**
     * @var array
     */
    protected $defaults
        = [
            'level0'       => 'sortable',
            'level1'       => '',
            'level2'       => '',
            'level3'       => '',
            'level4'       => '',
            'max'          => 12,
            'dropdownIcon' => '&nbsp;<i class="fa fa-tail"></i>',
            'moreLabel'    => 'More',
        ];

    /**
     * @param int            $level
     * @param NavigationItem $item
     *
     * @return string
     */
    public function renderItem($level, $item)
    {
        $href = null;
        // validate passed acl
        if ($item->acl and !\Phpfox::allow(null, $item->acl)) {
            return '';
        }


        $label = _text($item->label, 'menu');
        if ($item->type == 'separator') {
            $label .= '<sup>separator</sup>';
        }


        $id = $item->get('id');
        $name = $item->get('name');
        $disabled = $item->get('enable') ? '' : 'disabled';
        $sup = $item->get('enable') ? '' : '<sup class="text-info">disabled</sup>';
        $append
            = _sprintf('<span class="pull-right"><a class="" {5} data-cmd="menu.item.delete" data-id="{3}" data-message="{2}" data-message2="{4}">{0}</a>&middot;<a class="" data-id="{3}" data-cmd="menu.item.edit">{1}</a></span>',
            [
                _text('delete'),
                _text('edit'),
                _text('Are you sure?'),
                $id,
                _text('Oops!, Can not remove a parent item. <br/> Move <strong>all children</strong> before delete this item!'),
                $item->get('custom') ? ' data-custom="1" ' : ' data-custom="0" ',
            ]);

        if (!empty($item->children) && $level < $this->level) {
            $childrenHtml = $this->renderChildren($level + 1, $item->children, $name);
            return '<li data-id="' . $id . '" data-name="' . $name . '">'
                . '<div class="menu-label ' . $disabled . '"><span class="disclose"><span></span></span>'
                . $label . $append . $sup . '</div>'
                . $childrenHtml . '</li>';
        } else {
            return '<li data-id="' . $id . '" data-name="' . $name . '"><div class="menu-label ' . $disabled . '">'
                . $label . $sup
                . $append . '</div><ol class="" data-name="' . $name . '"></ol></li>';
        }
    }

    /**
     * @param int   $level
     * @param array $items
     * @param       $name
     *
     * @return string
     */
    public function renderChildren($level, $items, $name)
    {
        $content = [];

        foreach ($items as $item) {
            $content[] = $this->renderItem($level, $item);
        }

        return '<ol class="" data-name="' . $name . '">' . implode('', $content) . '</ol>';
    }
}