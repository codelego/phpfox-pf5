<?php
namespace Phpfox\Navigation;


class NavigationItem
{
    /**
     * @var string
     */
    public $id, $name, $section, $menu, $acl, $event, $packageId, $label, $type, $route, $url;

    /**
     * @var array
     */
    public $params = [];

    /**
     * @var array
     */
    public $extra = [];

    /**
     * @var bool
     */
    public $active = false;

    /**
     * @var NavigationItem
     */
    public $children = [];

    public function exchangeArray($data)
    {
        $this->id = @$data['id'];
        $this->section = @$data['parent'];
        $this->menu = @$data['menu'];
        $this->name = @$data['name'];
        $this->acl = @$data['acl'];
        $this->event = @$data['event'];
        $this->packageId = @$data['module'];
        $this->route = @$data['route'];
        $this->extra = @$data['extra'];
        $this->label = @$data['label'];
        $this->type = @$data['type'];
        $this->params = @$data['params'];
        $this->active = @$data['active'];
        $this->children = [];
    }
}