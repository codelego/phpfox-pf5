<?php

namespace Neutron\Blog\Service;


class BlogCategoryManager
{
    public function hasName($name)
    {
        return \Phpfox::with('blog_category')
                ->select()
                ->where('name=?', (string)$name)
                ->first() != null;
    }
}