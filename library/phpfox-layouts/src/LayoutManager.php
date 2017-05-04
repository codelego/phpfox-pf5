<?php

namespace Phpfox\Layout;

use Phpfox\View\ViewModel;

class LayoutManager extends ViewModel
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

        _emit('onViewLayoutPrepare', $this);

        $layoutPage = \Phpfox::get('layout_loader')->loadForRender($this->getPageName(), $this->getThemeId());

        $content = $layoutPage->render();

        $this->assign([
            'layout_content' => $content,
        ]);

        return $this;
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