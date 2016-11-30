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
        \Phpfox::get('html.header')->get('html.header.title')
            ->set($title);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTitle()
    {
        \Phpfox::get('html.header.title')->clear();
        return $this;
    }

    /**
     * @param  string $separator
     *
     * @return $this
     */
    public function setTitleSeparator($separator)
    {
        \Phpfox::get('html.header.title')->setSeparator($separator);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitleSeparator()
    {
        return \Phpfox::get('html.header.title')->getSepartor();
    }

    /**
     * @param  string|array $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords)
    {
        \Phpfox::get('html.header.keyword')->set($keywords);
        return $this;
    }

    /**
     * @return $this
     */
    public function clearKeywords()
    {
        \Phpfox::get('html.header.keyword')->clear();
        return $this;
    }

    /**
     * @param string $title
     * @param string $href
     *
     * @return $this
     */
    public function addBreadcrumb($title, $href)
    {
        \Phpfox::get('breadcrumb')->add($title, $href);
        return $this;
    }

    /**
     * @return Breadcrumb
     */
    public function breadcrumb()
    {
        return \Phpfox::get('breadcrumb');
    }

    /**
     * @return HeadMeta
     */
    public function headMeta()
    {
        return \Phpfox::get('html.header.meta');
    }

    /**
     * @param string $name
     * @param array  $props
     *
     * @return $this
     */
    public function addMeta($name, $props = [])
    {
        \Phpfox::get('html.header.meta')->add($name, $props);
        return $this;
    }

    public function clearMeta()
    {
        \Phpfox::get('html.header.meta')->clear();

        return $this;
    }

    /**
     * @return HeadOpenGraph
     */
    public function openGraph()
    {
        return \Phpfox::get('html.header.open_graph');
    }

    /**
     * @return HeadLink
     */
    public function links()
    {
        return \Phpfox::get('html.header.link');
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
        \Phpfox::get('html.header.link')->add($key, $href, $props);
        return $this;
    }


}