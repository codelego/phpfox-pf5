<?php

namespace Phpfox\Paging;


abstract class AbstractPaging implements PagingInterface
{
    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var int
     */
    protected $pageNumber = 1;

    /**
     * @var int
     */
    protected $pageCount;

    /**
     * @var int
     */
    protected $itemCount;

    /**
     * @var
     */
    protected $route;

    /**
     * @var bool
     */
    protected $noLimit = false;

    /**
     * @var string
     */
    protected $render = 'default';

    /**
     * @var int
     */
    protected $startIndex = 0;

    /**
     * @var array
     */
    protected $items;

    /**
     * @var string
     */
    protected $urlPath = '';

    /**
     * @var array
     */
    protected $urlParams = [];

    public function count()
    {
        return $this->getItemCount();
    }

    /**
     * @param int $itemCount
     */
    public function setItemCount($itemCount)
    {
        $this->itemCount = $itemCount;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param $limit
     *
     * @return $this
     */
    public function setLimit($limit)
    {
        $limit = (int)$limit;
        $this->limit = $limit < 0 ? 10 : ($limit > 50 ? 50 : $limit);
        return $this;
    }

    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     *
     * @return $this
     */
    public function setPageNumber($pageNumber)
    {
        $pageNumber = (int)$pageNumber;
        $this->pageNumber = $pageNumber < 1 ? 1 : $pageNumber;
        return $this;
    }

    /**
     * @param int $pageCount
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     *
     * @return $this
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNoLimit()
    {
        return $this->noLimit;
    }

    /**
     * @param bool $noLimit
     *
     * @return $this
     */
    public function setNoLimit($noLimit)
    {
        $this->noLimit = $noLimit;
        return $this;
    }

    /**
     * @return string
     */
    public function getRender()
    {
        return $this->render;
    }

    /**
     * @return int
     */
    public function getStartIndex()
    {
        return $this->startIndex;
    }

    /**
     * @param int $startIndex
     *
     * @return $this
     */
    public function setStartIndex($startIndex)
    {
        $this->startIndex = $startIndex;
        return $this;
    }

    public function getPageUrl($pageNumber)
    {
        return $this->urlPath . '?' . http_build_query(array_merge($this->urlParams, ['page' => $pageNumber]));
    }

    public function setUrl($string)
    {
        $array = array_merge(['path' => '', 'query' => ''], parse_url($string));

        $this->urlPath = $array['path'];

        parse_str($array['query'], $this->urlParams);

        return $this;
    }

    /**
     * @param string $render
     *
     * @return $this
     */
    public function setRender($render)
    {
        $this->render = $render;
        return $this;
    }

    public function render($params = [])
    {
        $class = \Phpfox::param('pagination.decorators', $this->getRender());

        if (!$class) {
            throw new \InvalidArgumentException(
                _sprintf('Oops! Pagination decorator {0} does not exists.', [$this->getRender()]));
        }

        /** @var DecoratorInterface $decorator */
        $decorator = new $class($params);

        return $decorator->render($this);
    }
}