<?php

namespace Phpfox\Assets;

class AssetsFacades
{
    public function __construct()
    {
    }

    /**
     * @param string|array $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        _service('html.title')->set($title);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTitle()
    {
        _service('html.title')->clear();
        return $this;
    }

    /**
     * @param  string $separator
     *
     * @return $this
     */
    public function setTitleSeparator($separator)
    {
        _service('html.title')->setSeparator($separator);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitleSeparator()
    {
        return _service('html.title')->getSepartor();
    }

    /**
     * @see HeadKeyword::set()
     *
     * @param  string|array $keywords
     *
     * @return $this
     */
    public function setKeyword($keywords)
    {
        _service('html.keyword')->set($keywords);
        return $this;
    }

    /**
     * @see HeadDescription::set()
     *
     * @param  string|array $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        _service('html.description')->set($description);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearKeywords()
    {
        _service('html.keyword')->clear();
        return $this;
    }

    /**
     * @see ExternalStyle::add()
     *
     * @param string      $key
     * @param string|null $path
     * @param array       $props
     *
     * @return $this
     */
    public function addStyle($key, $path = null, $props = [])
    {
        _service('html.start.style')->add($key, $path, $props);
        return $this;
    }

    /**
     * @see ExternalStyle::add()
     *
     * @param string      $key
     * @param string|null $path
     * @param array       $props
     *
     * @return $this
     */
    public function prependStyle($key, $path = null, $props = [])
    {
        _service('html.start.style')->prepend($key, $path, $props);
        return $this;
    }

    /**
     * @param string $name
     * @param array  $props
     *
     * @return $this
     */
    public function addMeta($name, $props = [])
    {
        _service('html.meta')->add($name, $props);
        return $this;
    }

    /**
     * @param array $props
     *
     * @return $this
     */
    public function addLink($props = [])
    {
        _service('html.link')->add($props);
        return $this;
    }

    /**
     * @see ExternalScript::add()
     *
     * @param string      $key
     * @param string|null $path
     * @param array       $props
     *
     * @return $this
     */
    public function addScripts($key, $path, $props = [])
    {
        _service('html.shutdown.script')->add($key, $path, $props);
        return $this;
    }

    /**
     * @return string
     */
    public function getStartHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return _service($v)->getHtml();
        }, [
            'html.meta',
            'html.title',
            'html.keyword',
            'html.description',
            'html.open_graph',
            'html.link',
            'html.start.style',
            'html.start.inline_style',
            'html.start.script',
            'html.start.inline_script',
            'html.start.static_html',
            'require_css',
        ]));
    }

    /**
     * Get html script of footer
     *
     * @return string
     */
    public function getShutdownHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return _service($v)->getHtml();
        }, [
            'html.shutdown.script',
            'require_js',
            'require_css',
        ]));

    }
}

