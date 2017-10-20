<?php

namespace Phpfox\Paging;


use Phpfox\Db\SqlSelect;

class SqlSelectPagination extends AbstractPaging
{
    /**
     * @var SqlSelect
     */

    protected $initiator;


    public function __construct($data)
    {
        $this->initiator = $data;
    }

    public function prepare()
    {
        if (!$this->noLimit and $this->pageNumber) {
            $offset = ($this->pageNumber - 1) * $this->limit;
            $this->initiator->limit($this->limit, $offset);
        } else {
            $this->initiator->limit(0, 0);
        }

        $this->urlParams =  $_GET;
        return $this;
    }

    public function getItems()
    {
        if (is_null($this->items)) {
            $this->items = $this->initiator->all();
        }
        return $this->items;
    }

    /**
     * @return int
     */
    public function getItemCount()
    {
        if (null === $this->itemCount) {
            $this->itemCount = (int)$this->initiator->count();
        }
        return $this->itemCount;
    }

    public function getPageCount()
    {
        if ($this->noLimit) {
            $this->pageCount = 1;
        } elseif (null == $this->pageCount) {
            $this->pageCount = ceil($this->getItemCount() / $this->getLimit());
        }
        return $this->pageCount;
    }


    public function getIterator()
    {
        $this->getItems();
        return new \ArrayIterator($this->items);
    }
}