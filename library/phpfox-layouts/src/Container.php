<?php

namespace Phpfox\Layout;


use Phpfox\View\ViewModel;

class Container
{
    /**
     * @var Location[]
     */
    protected $locations = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * LayoutContainer constructor.
     * required
     * [container_id=>, grid_id=>, action_id, page_id]
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->get('container_id');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('container_id');
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    /**
     * @return string
     */
    public function getGridId()
    {
        return $this->get('grid_id');
    }

    /**
     * @return Location[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param Location[] $locations
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;
    }

    /**
     * @return string
     */
    public function getTypeId()
    {
        return $this->get('type_id');
    }


    /**
     * add new location
     *
     * @param Location $location
     */
    public function addLocation($location)
    {
        $this->locations[$location->getName()] = $location;
    }

    /**
     * Get parameters
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * Set parameters
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return string
     */
    public function getScriptForEdit()
    {
        return 'grid/edit-' . $this->getGridId();
    }

    /**
     * @return string
     */
    public function getScriptForRender()
    {
        return 'grid/' . $this->getGridId();
    }

    /**
     * @return string
     */
    public function render()
    {
        $data = [];
        foreach ($this->locations as $key => $location) {
            $data[$key] = $location->render();
        }

        return (new ViewModel($data, $this->getScriptForRender()))->render();
    }

    /**
     * @return string
     */
    public function renderForEdit()
    {
        $data = ['container' => $this];

        foreach ($this->locations as $key => $location) {
            $data[$key] = $location->renderForEdit();
        }

        $data['content'] = (new ViewModel($data, $this->getScriptForEdit()))->render();

        return (new ViewModel($data,
            'layout-editor/edit-container'))->render();
    }
}