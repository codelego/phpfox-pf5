<?php

namespace Phpfox\Form;


abstract class AbstractFormRender implements FormDecoratorInterface
{
    public function renderElements($form)
    {
        // TODO: Implement renderElements() method.
    }

    public function renderButtons($form)
    {
        // TODO: Implement renderButtons() method.
    }

    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderTitle($form)
    {
        $string = $form->getTitle();

        if (empty($string)) {
            return '';
        }

        return '<div class="panel-heading"><div class="panel-title">' . $string . '</div></div>';
    }

    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderInfo($form)
    {
        $string = $form->getInfo();

        if (empty($string)) {
            return '';
        }

        return '<p class="form-info">' . nl2br($string) . '</p>';
    }
}