<?php

namespace Phpfox\Html;

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
    protected $_baseUrl;
    /**
     * @var
     */
    protected $_modules;
    /**
     * Script list
     *
     * @var array
     */
    protected $_scripts = [];
    /**
     * @var array
     */
    protected $_paths = [];
    /**
     * @var array
     */
    protected $_bundles = [];
    /**
     * @var array
     */
    protected $_deps = ['jquery', 'bootstrap'];
    /**
     * @var array
     */
    protected $_shim = [];

    public function __construct()
    {
        $this->_shim = \Phpfox::getParams('requirejs.shim');
        $this->_paths = \Phpfox::getParams('requirejs.paths');
    }

    /**
     * @return array
     */
    public function getScripts()
    {
        return $this->_scripts;
    }

    /**
     * @param array $_scripts
     */
    public function setScripts($_scripts)
    {
        $this->_scripts = $_scripts;
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
     * Add dependency
     *
     * @param string|array $values
     *
     * @return $this
     */
    public function deps($values)
    {
        if (is_string($values)) {
            $this->_deps[] = $values;
        } else {
            foreach ($values as $value) {
                $this->_deps[] = $value;
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
        array_unshift($this->_deps, $value);

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

        $this->_scripts[$name] = $code;

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
        $this->_scripts = array_merge([$name => $string], $this->_scripts);

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
        $this->_paths[$name] = $path;

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
            $this->_paths[$name] = $path;
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

        if (empty($this->_bundles[$name])) {
            $this->_bundles[$name] = [];
        }

        foreach ($value as $val) {
            $this->_bundles[$name][] = $val;
        }

        $this->_bundles[$name]
            = array_values(array_unique($this->_bundles[$name]));

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
        return $this->getHtml();
    }

    /**
     * @return string
     */
    public function renderConfig()
    {
        \Phpfox::emit('onBeforeJavascriptRender', $this);

        $config = [
            'baseUrl' => $this->getBaseUrl(),
            'paths'   => $this->getPaths(),
            'bundles' => $this->getBundles(),
            'shim'    => $this->getShim(),
            //            'waitSeconds' => 15,
        ];

        return 'requirejs.config(' . json_encode($config, JSON_PRETTY_PRINT) . ');';
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
        return $this->_paths;
    }

    /**
     * @param array $_paths
     */
    public function setPaths($_paths)
    {
        $this->_paths = $_paths;
    }

    /**
     * @return array
     */
    public function getBundles()
    {
        return $this->_bundles;
    }

    /**
     * @param array $_bundles
     */
    public function setBundles($_bundles)
    {
        $this->_bundles = $_bundles;
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

        foreach ($this->_scripts as $script) {
            $response[] = $script;
        }

        $response[] = 'if(typeof BootInit == "function"){BootInit();}';

        $content = implode(';' . PHP_EOL, $response);

        $dependency = json_encode($this->_deps, JSON_PRETTY_PRINT);

        return 'require(' . $dependency . ', function(){' . PHP_EOL . $content
            . PHP_EOL . ' });';
    }

    /**
     * @return array
     */
    public function getDeps()
    {
        return array_values(array_unique($this->_deps));
    }

    /**
     * @param array $_deps
     *
     * @return $this
     */
    public function setDeps($_deps)
    {
        $this->_deps = $_deps;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return implode(PHP_EOL, [
            '<script type="text/javascript">',
            $this->renderConfig(),
            $this->renderScript(),
            '</script>',
        ]);
    }

    public function getConfigHtml()
    {
        return implode(PHP_EOL, [
            '<script type="text/javascript">',
            $this->renderConfig(),
            '</script>',
        ]);
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