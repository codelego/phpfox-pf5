<?php

namespace Neutron\Video\Service;

use Neutron\Video\Model\VideoProvider;
use Neutron\Video\Provider\ParseException;
use Neutron\Video\Provider\ProviderInterface;

class ProviderManager
{
    /**
     * @var array
     */
    private $classes = [];

    /**
     * @var ProviderInterface[]
     */
    private $container = [];

    /**
     * Providers constructor.
     */
    public function __construct()
    {
        $this->getProviderClasses();
    }

    /**
     * @return array
     */
    public function getProviderClasses()
    {
        if (empty($this->classes)) {
            /** @var VideoProvider[] $items */
            $items = _model('video_provider')
                ->select()
                ->where('is_active=1')
                ->all();
            foreach ($items as $item) {
                $this->classes[$item->getId()] = $item->getProviderClass();
            }
        }

        return $this->classes;
    }

    /**
     * @param string $name
     *
     * @return  ProviderInterface
     */
    public function get($name)
    {
        return isset($this->container[$name]) ? $this->container[$name]
            : $this->container[$name] = $this->build($name);
    }

    public function has($name)
    {
        return !empty($this->container[$name]) or !empty($this->classes[$name]);
    }


    /**
     * @param string            $name
     * @param ProviderInterface $provider
     */
    public function set($name, $provider)
    {
        $this->container[$name] = $provider;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function build($name)
    {
        if (!isset($this->classes[$name])) {
            throw new \InvalidArgumentException("Oops! video provider {$name} does not support");
        }

        if (!class_exists($this->classes[$name])) {
            throw new \InvalidArgumentException("Oops! video provider {$name} does not support");
        }

        return new $this->classes[$name];
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_keys($this->classes);
    }
    
    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param  string $url
     *
     * @return \Neutron\Video\Provider\ParseResult
     * @throws ParseException
     */
    public function parseFromUrl($url)
    {
        foreach ($this->all() as $name) {
            if ($this->get($name)->isVideoLink($url)) {
                return $this->get($name)->parseFromUrl($url);
            }
        }
        throw new ParseException("Oops! Invalid video url");
    }
}