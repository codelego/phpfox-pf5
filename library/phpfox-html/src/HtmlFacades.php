<?php

namespace Phpfox\Html;

class HtmlFacades
{
    public function __construct(){}

    /**
     * @param string|array $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        service('html.header')->get('html.header.title')->set($title);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTitle()
    {
        service('html.header.title')->clear();
        return $this;
    }

    /**
     * @param  string $separator
     *
     * @return $this
     */
    public function setTitleSeparator($separator)
    {
        service('html.header.title')->setSeparator($separator);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitleSeparator()
    {
        return service('html.header.title')->getSepartor();
    }

    /**
     * @param  string|array $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords)
    {
        service('html.header.keyword')->set($keywords);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearKeywords()
    {
        service('html.header.keyword')->clear();
        return $this;
    }

    /**
     * @return Breadcrumb
     */
    public function breadcrumb()
    {
        return service('breadcrumb');
    }

    /**
     * @return HeadMeta
     */
    public function headMeta()
    {
        return service('html.header.meta');
    }

    /**
     * @param string $name
     * @param array  $props
     *
     * @return $this
     */
    public function addMeta($name, $props = [])
    {
        service('html.header.meta')->add($name, $props);
        return $this;
    }

    public function clearMeta()
    {
        service('html.header.meta')->clear();

        return $this;
    }

    /**
     * @return HeadOpenGraph
     */
    public function openGraph()
    {
        return service('html.header.open_graph');
    }

    /**
     * @return HeadLink
     */
    public function links()
    {
        return service('html.header.link');
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
        service('html.header.link')->add($key, $href, $props);
        return $this;
    }
}