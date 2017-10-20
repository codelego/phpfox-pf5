<?php

namespace Neutron\Blog\Block;

use Phpfox\View\Component;
use Phpfox\View\ViewModel;

class CategoryComponent extends Component
{
    public function run()
    {
        $items = \Phpfox::model('blog_category')
            ->select()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'blog/block/category');
    }
}