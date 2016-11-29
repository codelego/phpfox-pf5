<?php
/**
 * Copyright (c) 2016. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Phpfox\Mvc;

/**
 * Class ViewLayout
 *
 * @package Phpfox\Mvc
 */
class ViewLayout extends ViewModel
{
    /**
     * @var string
     */
    protected $pageName = '';

    public function __construct()
    {
        parent::__construct('layout/master/default', []);
    }

    /**
     * @return $this
     */
    public function prepare()
    {
        events()->trigger('onViewLayoutPrepare', $this);

        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @param string $pageName
     *
     * @return $this
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
        return $this;
    }
}