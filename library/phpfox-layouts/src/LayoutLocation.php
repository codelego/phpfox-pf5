<?php

namespace Phpfox\Layout;

use Phpfox\Form\Element;

class LayoutLocation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * full section, section, column
     *
     * @var string
     */
    protected $type;

    /**
     * @var Element[]
     */
    protected $elements = [];

    /**
     * @return string
     */
    public function render()
    {
        if (empty($this->elements)) {
            return '';
        }

        $htmlArray = [];

        foreach ($this->elements as $element) {
            $htmlArray[] = $element->render();
        }

        return implode('', $htmlArray);
    }
}