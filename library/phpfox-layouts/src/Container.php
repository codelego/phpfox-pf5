<?php

namespace Phpfox\Layout;


use Phpfox\View\ViewModel;

class Container
{
    /**
     * @var array
     */
    protected $locations = [];

    /**
     * @var array
     */
    protected $blocks = [];

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
     * @return string
     */
    public function getTypeId()
    {
        return $this->get('type_id');
    }


    /**
     * add new location
     *
     * @param string $locationId
     * @param array  $params
     *
     * @return bool
     */
    public function addLocation($locationId, $params = [])
    {
        $this->locations[$locationId] = $params;
        if (empty($this->blocks[$locationId])) {
            $this->blocks[$locationId] = [];
        }

        return true;
    }

    /**
     * @param string $locationId
     * @param array  $params
     *
     * @return bool
     */
    public function mergeLocation($locationId, $params)
    {
        if (empty($this->locations[$locationId])) {
            return false;
        }

        $this->locations[$locationId] = array_merge($params, $this->locations[$locationId]);

        return true;
    }

    /**
     * @param string $locationId
     * @param array  $block
     *
     * @return bool
     */
    public function addBlock($locationId, $block)
    {
        if (!isset($this->locations[$locationId])) {
            return false;
        }
        $this->blocks[$locationId][] = $block;

        return true;
    }

    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
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
        $layouts = \Phpfox::get('layouts');

        foreach ($this->locations as $locationId => $location) {
            $data[$locationId] = '';
            $htmlArray = [];

            foreach ($this->blocks[$locationId] as $block) {
                $htmlArray[] = $layouts->renderBlock($block['block_class'], $block);
            }
            $data[$locationId] = implode(PHP_EOL, $htmlArray);
        }

        return (new ViewModel($data, 'grid/' . $this->getGridId()))->render();
    }

    /**
     * @return string
     */
    public function renderForEdit()
    {
        $data = ['container' => $this];

        foreach ($this->locations as $locationId => $location) {
            $data[$locationId] = (new ViewModel([
                'blocks'   => $this->blocks[$locationId],
                'location' => $location,
            ], 'layout-editor/edit-location'))->render();
        }

        $data['content'] = (new ViewModel($data, 'grid/edit-' . $this->getGridId()))->render();

        return (new ViewModel($data,
            'layout-editor/edit-container'))->render();
    }
}