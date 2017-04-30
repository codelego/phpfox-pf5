<?php

namespace Neutron\Blog\Block;

use Phpfox\Layout\LayoutBlock;
use Phpfox\View\ViewModel;

class CategoryBlock extends LayoutBlock
{
    public function run()
    {
        $items = \Phpfox::with('blog_category')
            ->select()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'blog/block/category');
    }
}