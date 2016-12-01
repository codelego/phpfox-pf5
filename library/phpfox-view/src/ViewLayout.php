<?php

namespace Phpfox\View;

/**
 * Class ViewLayout
 *
 * @package Phpfox\View
 */
class ViewLayout extends ViewModel
{
    /**
     * @var string
     */
    protected $pageName;

    /**
     * @return $this
     */
    public function prepare()
    {
        if (!$this->template) {
            $this->template = 'layout.master.default';
        }

        \Phpfox::html()->addScripts('require', null)
            ->addStyle('bootstrap', null);

        \Phpfox::emit('onViewLayoutPrepare', $this);

        $content  = '';

        $data = \Phpfox::get('mvc.response')->getData();

        if($data instanceof ViewModel){
            $content  = $data->render();
        }

        $this->assign([
            'layout_content' => $content,
        ]);

        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
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
}