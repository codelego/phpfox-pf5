<?php

namespace Phpfox\Navigation;


trait NavigationDecoratorTrait
{
    /**
     * @var array
     */
    protected $data;

    /**
     * render from section
     *
     * @var string
     */
    protected $section;

    /**
     * Menu name
     *
     * @var string
     */
    protected $menu;

    /**
     * List of active items
     *
     * @var array|string
     */
    protected $active;

    /**
     * max number to render
     *
     * @var number
     */
    protected $level;

    /**
     * @var array
     */
    protected $context;


    public function __construct(
        $menu,
        $parentId,
        $active,
        $level,
        $context
    ) {

        $this->menu = $menu;
        $this->section = $parentId;
        $this->active = $active;
        $this->level = $level;
        $this->context = $context;

    }
}