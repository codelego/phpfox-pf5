<?php

namespace Phpfox\View;

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
        \Phpfox::get('html.title')->set($title);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTitle()
    {
        \Phpfox::get('html.title')->clear();
        return $this;
    }

    /**
     * @param  string $separator
     *
     * @return $this
     */
    public function setTitleSeparator($separator)
    {
        \Phpfox::get('html.title')->setSeparator($separator);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitleSeparator()
    {
        return \Phpfox::get('html.title')->getSepartor();
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
        \Phpfox::get('html.keyword')->set($keywords);
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
        \Phpfox::get('html.description')->set($description);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearKeywords()
    {
        \Phpfox::get('html.keyword')->clear();
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
        \Phpfox::get('html.start.style')->add($key, $path, $props);
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
        \Phpfox::get('html.start.style')->prepend($key, $path, $props);
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
        \Phpfox::get('html.meta')->add($name, $props);
        return $this;
    }

    /**
     * @param array $props
     *
     * @return $this
     */
    public function addLink($props = [])
    {
        \Phpfox::get('html.link')->add($props);
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
        \Phpfox::get('html.shutdown.script')->add($key, $path, $props);
        return $this;
    }

    /**
     * @return string
     */
    public function getStartHtml()
    {
        return implode(PHP_EOL, array_map(function ($v) {
            return \Phpfox::get($v)->getHtml();
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
            return \Phpfox::get($v)->getHtml();
        }, [
            'html.shutdown.script',
            'require_js',
            'require_css',
        ]));

    }
}

