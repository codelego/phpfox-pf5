<?php

namespace Phpfox\View;

class LayoutFacades extends ViewModel
{
    /**
     * @var string
     */
    protected $pageName;

    /**
     * @var string
     */
    protected $themeId = 'default';

    /**
     * @var bool
     */
    protected $ajaxLoad = false;

    /**
     * @return $this
     */
    public function prepare()
    {
        if (!$this->template) {
            $this->template = 'layout/default';
        }

        \Phpfox::get('assets')
            ->addScripts('require', null)
            ->addStyle('custom', null)
            ->prependStyle('main', null)
            ->prependStyle('font', null);

        \Phpfox::trigger('onViewLayoutPrepare', $this);

        $content = \Phpfox::get('layout_loader')
            ->loadForRender($this->getPageName(), $this->getThemeId())
            ->render();

        $this->assign([
            'layout_content' => $content,
        ]);

        return $this;
    }

    /**
     * @param bool $ajaxLoad
     *
     * @return $this
     */
    public function setAjaxLoad($ajaxLoad)
    {
        if ($ajaxLoad) {
            if (!$this->ajaxLoad) {
                $this->setTemplate($this->getTemplate() . '-ajax');
            }
        } else {

        }

        $this->ajaxLoad = $ajaxLoad;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAjaxLoad()
    {
        return $this->ajaxLoad;
    }

    /**
     * @return string
     */
    public function getThemeId()
    {
        if (null == $this->themeId) {
            $this->setThemeId(\Phpfox::get('core.themes')->getDefault()->getId());
        }
        return $this->themeId;
    }

    /**
     * @param string $themeId
     *
     * @return $this
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;

        \Phpfox::get('template')
            ->preferThemes([$themeId]);
        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        if (null == $this->pageName) {
            $this->pageName = \Phpfox::get('dispatcher')->getFullActionName();
        }
        return $this->pageName;
    }

    /**
     * @param string $pageName
     *
     * @return $this
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
        return $this;
    }

    /**
     * @return string
     */
    public function getStyleBaseUrl()
    {
        return '/pf5/static/' . 'themes/' . $this->getThemeId() . '/css';
    }

    /**
     * @param string $cls
     * @param array  $params
     *
     * @return string
     */
    public function renderBlock($cls, $params = [])
    {
        if (!class_exists($cls)) {
            return '';
        }

        /** @var Component $component */
        $component = new $cls($params);

        $result = $component->run();

        if (is_string($result)) {
            return $result;
        } else {
            if ($result instanceof ViewModel) {
                return $result->render();
            }
        }
        return '';
    }
}