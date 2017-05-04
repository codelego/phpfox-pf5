<?php

namespace Neutron\Blog\Block;

use Phpfox\Layout\Component;
use Phpfox\View\ViewModel;

class CategoryComponent extends Component
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