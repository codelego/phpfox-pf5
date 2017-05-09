<?php

namespace Phpfox\Paging;

interface PagingInterface extends \Countable, \IteratorAggregate
{
    /**
     * @param $data
     */
    public function __construct($data);

    /**
     * Get total items of paging, Not current item count
     *
     * @return int
     */
    public function count();

    /**
     * Get item count for current page.
     *
     * @return int
     */
    public function getItemCount();

    /**
     * @return int
     */
    public function getPageCount();

    /**
     * @param bool $noLimit
     *
     * @return $this
     */
    public function setNoLimit($noLimit);

    /**
     * @return $this
     */
    public function prepare();

    /**
     * Return all items
     */
    public function isNoLimit();

    /**
     * @return \IteratorAggregate
     */
    public function getItems();

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @param $limit
     *
     * @return $this
     */
    public function setLimit($limit);

    /**
     * @return int
     */
    public function getPageNumber();

    /**
     * @param int $pageNumber
     *
     * @return $this
     */
    public function setPageNumber($pageNumber);

    /**
     * @param int $totalPage
     */
    public function setPageCount($totalPage);

    /**
     * @return mixed
     */
    public function getRoute();

    /**
     * @param mixed $route
     *
     * @return $this
     */
    public function setRoute($route);

    /**
     * @return string
     */
    public function getRender();

    /**
     * @param string $render
     *
     * @return $this
     */
    public function setRender($render);

    /**
     * @param array $params
     *
     * @return string
     */
    public function render($params = []);

    /**
     * @param $string
     *
     * @return mixed
     */
    public function setUrl($string);

    /**
     * @param $pageNumber
     *
     * @return string
     */
    public function getPageUrl($pageNumber);

    /**
     * @return int
     */
    public function getStartIndex();

    /**
     * @param $startIndex
     *
     * @return $this
     */
    public function setStartIndex($startIndex);
}