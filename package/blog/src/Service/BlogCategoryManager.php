<?php

namespace Neutron\Blog\Service;


use Neutron\Blog\Model\BlogCategory;

class BlogCategoryManager
{
    /**
     * @param string $name
     *
     * @return int
     */
    public function findIdByName($name)
    {
        /** @var BlogCategory $entry */
        $entry = _with('blog_category')
            ->select()
            ->where('name=?', (string)$name)
            ->first();

        if ($entry) {
            return $entry->getId();
        }

        return 0;
    }

    public function hasName($name)
    {
        return _with('blog_category')
                ->select()
                ->where('name=?', (string)$name)
                ->first() != null;
    }
}