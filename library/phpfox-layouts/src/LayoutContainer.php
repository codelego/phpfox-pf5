<?php

namespace Phpfox\Layout;


use Phpfox\View\ViewModel;

class LayoutContainer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var LayoutLocation[]
     */
    protected $locations = [];

    /**
     * @var string
     */
    protected $gridId;

    /**
     * @var string
     */
    protected $typeId;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * LayoutContainer constructor.
     *
     * @param string $id
     * @param string $typeId
     * @param string $gridId
     * @param array  $params
     */
    public function __construct($id, $typeId, $gridId, $params = [])
    {
        $this->name = $id;
        $this->typeId = $typeId;
        $this->gridId = $gridId;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getGridId()
    {
        return $this->gridId;
    }

    /**
     * @return LayoutLocation[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param LayoutLocation[] $locations
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;
    }

    /**
     * @param string $gridId
     */
    public function setGridId($gridId)
    {
        $this->gridId = $gridId;
    }

    /**
     * @return string
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param string $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * add new location
     *
     * @param LayoutLocation $location
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
    public function render()
    {
        $data = [];
        foreach ($this->locations as $key => $location) {
            $data[$key] = $location->render();
        }

        $script = $this->get('layout', 'grid/' . $this->gridId);

        return (new ViewModel($data, $script))->render();
    }

    /**
     * @return string
     */
    public function renderForEdit()
    {
        $data = [];
        foreach ($this->locations as $key => $location) {
            $data[$key] = $location->renderForEdit();
        }

        $data['container'] = $this;

        $data['content'] = (new ViewModel($data,
            'grid/edit-' . $this->gridId))->render();

        return (new ViewModel($data,
            'layout-editor/edit-container'))->render();
    }
}