<?php

namespace Phpfox\Html;

class HtmlFacades
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
        \Phpfox::getService('html.header')->get('html.header.title')->set($title);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTitle()
    {
        \Phpfox::getService('html.header.title')->clear();
        return $this;
    }

    /**
     * @param  string $separator
     *
     * @return $this
     */
    public function setTitleSeparator($separator)
    {
        \Phpfox::getService('html.header.title')->setSeparator($separator);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitleSeparator()
    {
        return \Phpfox::getService('html.header.title')->getSepartor();
    }

    /**
     * @param  string|array $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords)
    {
        \Phpfox::getService('html.header.keyword')->set($keywords);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearKeywords()
    {
        \Phpfox::getService('html.header.keyword')->clear();
        return $this;
    }

    /**
     * @return Breadcrumb
     */
    public function breadcrumb()
    {
        return \Phpfox::getService('breadcrumb');
    }

    /**
     * @return HeadMeta
     */
    public function headMeta()
    {
        return \Phpfox::getService('html.header.meta');
    }

    /**
     * @param string $name
     * @param array  $props
     *
     * @return $this
     */
    public function addMeta($name, $props = [])
    {
        \Phpfox::getService('html.header.meta')->add($name, $props);
        return $this;
    }

    public function clearMeta()
    {
        \Phpfox::getService('html.header.meta')->clear();

        return $this;
    }

    /**
     * @return HeadOpenGraph
     */
    public function openGraph()
    {
        return \Phpfox::getService('html.header.open_graph');
    }

    /**
     * @return HeadLink
     */
    public function links()
    {
        return \Phpfox::getService('html.header.link');
    }

    /**
     * @param string $key
     * @param string $href
     * @param array  $props
     *
     * @return $this
     */
    public function addLink($key, $href, $props = [])
    {
        \Phpfox::getService('html.header.link')->add($key, $href, $props);
        return $this;
    }
}