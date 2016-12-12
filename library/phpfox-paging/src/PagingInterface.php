<?php

namespace Phpfox\Paging;

interface PagingInterface
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
    public function itemCount();

    /**
     * @return int
     */
    public function pageCount();

    /**
     * @param int $pageNumber
     * @param int $limit
     *
     * @return PagingInterface
     */
    public function paging($pageNumber, $limit);

    /**
     * Return all items
     */
    public function noLimit();

    /**
     * @return \IteratorAggregate
     */
    public function items();

    /**
     * @param int $pageNumber
     *
     * @return PagingInterface
     */
    public function setPage($pageNumber);

    /**
     * @param $limit
     *
     * @return PagingInterface
     */
    public function setLimit($limit);

    /**
     * @return int
     */
    public function getPage();

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @param string $name
     * @param array  $params
     *
     * @return PagingInterface
     */
    public function setRouting($name, $params);

    /**
     * @return bool
     */
    public function hasNext();

    /**
     * @return bool
     */
    public function hasPrev();

    /**
     * @return string
     */
    public function getNextUrl();

    /**
     * @return string
     */
    public function getPrevUrl();

    /**
     * @return array
     */
    public function getPager();

    /**
     * @param $pageNumber
     *
     * @return string
     */
    public function getUrl($pageNumber);

    /**
     * @return int
     */
    public function getStartIndexing();
}