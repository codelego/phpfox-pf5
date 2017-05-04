<?php

namespace Phpfox\Form;

class FormFacades
{
    /**
     * @var array
     */
    protected $container = [];

    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function render($element)
    {
        return $this->getRender($element->getRender())
            ->render($element);
    }

    /**
     * @param string $id
     *
     * @return RenderInterface
     */
    public function getRender($id)
    {
        if (null == $id) {
            $id = 'input';
        }
        return isset($this->container[$id]) ? $this->container[$id]
            : $this->container[$id] = $this->factory($id);
    }

    /**
     * @param string $id
     *
     * @return RenderInterface
     */
    public function factory($id)
    {
        $ref = \Phpfox::getParam('form_renders', $id);

        if (!$ref) {
            $ref = \Phpfox::getParam('form_renders', 'input');
        }

        return new $ref();
    }
}