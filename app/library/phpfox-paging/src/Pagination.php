<?php

namespace Phpfox\Paging;


use Phpfox\Db\SqlSelect;

class Pagination
{
    /**
     * @param mixed $initiator
     *
     * @return PagingInterface
     */
    public function factory($initiator)
    {
        if ($initiator instanceof SqlSelect) {
            return new SqlSelectPagination($initiator);
        }
    }

    /**
     * @param $name
     *
     * @return DecoratorInterface
     */
    public function getDecorator($name)
    {
        $class = _param('pagination.decorators', $name);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Pagination decorator '{$name}' does not exists.");
        }

        /** @var DecoratorInterface $decorate */
        return new $class;
    }
}