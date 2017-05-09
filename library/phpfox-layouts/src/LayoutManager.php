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

        _service('assets')
            ->addScripts('require', null)
            ->addStyle('custom', null)
            ->prependStyle('main', null)
            ->prependStyle('font', null);

        _emit('onViewLayoutPrepare', $this);

        $content =  _service('layout_loader')
            ->loadForRender($this->getPageName(), $this->getThemeId())
            ->render();

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
            $this->setThemeId(_service('core.themes')->getDefault()->getId());
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

        _service('template')
            ->preferThemes([$themeId]);
        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        if (null == $this->pageName) {
            $this->pageName = _service('dispatcher')->getFullActionName();
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