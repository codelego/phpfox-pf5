<?php

namespace Phpfox\RequireJs;

/**
 * Class RequireJs
 *
 * @package Phpfox\RequireJs
 */
class RequireJs
{

    /**
     *
     */
    const BUNDLE_NAME = 'dist/primary.bundle';
    /**
     * @var string
     */
    private $_baseUrl;
    /**
     * @var
     */
    private $_modules;
    /**
     * Script list
     *
     * @var array
     */
    private $scripts = [];
    /**
     * @var array
     */
    private $paths = [];
    /**
     * @var array
     */
    private $bundles = [];
    /**
     * @var array
     */
    private $dependency = ['jquery'];
    /**
     * @var array
     */
    private $_shim = [];

    /**
     * @return array
     */
    public function getScripts()
    {
        return $this->scripts;
    }

    /**
     * @param array $scripts
     */
    public function setScripts($scripts)
    {
        $this->scripts = $scripts;
    }

    /**
     * Add requirejs
     *
     * @param      $name
     * @param      $path
     * @param null $alias
     *
     * @return $this
     */
    public function modules($name, $path, $alias = null)
    {
        if (empty($alias)) {
            $alias = $name;
        }
        $this->_modules[$name] = ['path' => $path, 'name' => $alias];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->_modules;
    }

    /**
     * @param string|array $values
     *
     * @return $this
     */
    public function addDependency($values)
    {
        if (is_string($values)) {
            $this->dependency[] = $values;
        } else {
            foreach ($values as $value) {
                $this->dependency[] = $value;
            }
        }

        return $this;
    }

    /**
     * Add shim configures
     *
     * @param string       $name
     * @param string|array $deps
     * @param string       $export
     *
     * @return $this
     */
    public function shim($name, $deps, $export = null)
    {

        if (is_string($deps)) {
            $deps = explode(',', preg_replace('#\s+#gmi', '', $deps));
        }

        $config = ['deps' => $deps];

        if (!empty($export)) {
            $config['exports'] = $export;
        }

        $this->_shim[$name] = $config;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function prependDependency($value)
    {
        array_unshift($this->dependency, $value);

        return $this;
    }

    /**
     * @param string $name If empty,it's generate a unique string use php
     *                     uniqid().
     * @param string $code
     *
     * @return $this
     */
    public function addScript($name, $code)
    {
        if (empty($name)) {
            $name = uniqid('script_');
        }

        $this->scripts[$name] = $code;

        return $this;
    }

    /**
     * @param $name
     * @param $string
     *
     * @return $this
     */
    public function prependScript($name, $string)
    {
        $this->scripts = array_merge([$name => $string], $this->scripts);

        return $this;
    }

    /**
     * @param string $name
     * @param string $path
     *
     * @return $this
     */
    public function addPath($name, $path)
    {
        $this->paths[$name] = $path;

        return $this;
    }

    /**
     * @param array $paths
     *
     * @return $this
     */
    public function addPaths($paths)
    {
        foreach ($paths as $name => $path) {
            $this->paths[$name] = $path;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getPrimaryBundleName()
    {
        return self::BUNDLE_NAME;
    }

    /**
     * @param array|string $value
     *
     * @return $this
     */
    public function addPrimaryBundle($value)
    {

        $this->addBundle(self::BUNDLE_NAME, $value);

        return $this;
    }

    /**
     * @param string       $name
     * @param string|array $value
     *
     * @return $this
     */
    public function addBundle($name, $value)
    {

        if (is_string($value)) {
            $value = [$value];
        }

        if (empty($this->bundles[$name])) {
            $this->bundles[$name] = [];
        }

        foreach ($value as $val) {
            $this->bundles[$name][] = $val;
        }

        $this->bundles[$name]
            = array_values(array_unique($this->bundles[$name]));

        return $this;
    }

    /**
     * @param string $staticBaseUrl
     */
    public function baseUrl($staticBaseUrl)
    {
        $this->_baseUrl = $staticBaseUrl;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->render();
    }

    /**
     * @return string
     */
    public function render()
    {
        return '<script type="text/javascript">' . PHP_EOL
        . $this->renderConfig() . ' ; ' . PHP_EOL . $this->renderScript()
        . PHP_EOL . '</script>';
    }

    /**
     * @return string
     */
    public function renderConfig()
    {
        \app()->emit('onBeforeJavascriptRender', $this);

        $config = [
            'baseUrl' => $this->getBaseUrl(),
            'paths'   => $this->getPaths(),
            'bundles' => $this->getBundles(),
            'shim'    => $this->getShim(),
            //            'waitSeconds' => 15,
        ];

        return 'requirejs.config(' . json_encode($config, JSON_PRETTY_PRINT)
        . ');';
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        if (null == $this->_baseUrl) {
            $this->_baseUrl = PHPFOX_BASE_URL . 'static/';
        }

        return $this->_baseUrl;
    }

    /**
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @param array $paths
     */
    public function setPaths($paths)
    {
        $this->paths = $paths;
    }

    /**
     * @return array
     */
    public function getBundles()
    {
        return $this->bundles;
    }

    /**
     * @param array $bundles
     */
    public function setBundles($bundles)
    {
        $this->bundles = $bundles;
    }

    /**
     * @return array
     */
    public function getShim()
    {
        return $this->_shim;
    }

    /**
     * Get requirejs script with a there no.
     *
     * @return string
     */
    public function renderScript()
    {

        $response = [];

        foreach ($this->scripts as $script) {
            $response[] = $script;
        }

        $response[] = 'BootInit()';

        $content = implode(';' . PHP_EOL, $response);

        $dependency = json_encode($this->getDependency(), JSON_PRETTY_PRINT);

        return 'require(' . $dependency . ', function(){' . PHP_EOL . $content
        . PHP_EOL . ' });';
    }

    /**
     * @return array
     */
    public function getDependency()
    {
        return array_values(array_unique($this->dependency));
    }

    /**
     * @param array $dependency
     *
     * @return $this
     */
    public function setDependency($dependency)
    {
        $this->dependency = $dependency;

        return $this;
    }

    /**
     * @return string
     */
    public function renderScriptHtml()
    {
        return '<script type="text/javascript">' . PHP_EOL
        . $this->renderScript() . PHP_EOL . '</script>';
    }

    public function renderConfigHtml()
    {
        return '<script type="text/javascript">' . PHP_EOL
        . $this->renderConfig() . PHP_EOL . '</script>';
    }

    /**
     * @param $event
     */
    public function onAssetManagerGetHeader($event)
    {

    }

    /**
     * @param $event
     */
    public function onAssetManagerGetFooter($event)
    {

    }

    /**
     * @inheritdoc
     * @ignore
     */
    function __call($name, $arguments)
    {
        if ($name) {
            ;
        }
        if ($arguments) {
            ;
        }
    }


}