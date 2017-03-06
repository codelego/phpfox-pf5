<?php

namespace Phpfox\Form;

interface FormRenderInterface extends RenderInterface
{
    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderElements($form);

    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderButtons($form);

    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderTitle($form);

    /**
     * @param Form $form
     *
     * @return string
     */
    public function renderDesc($form);
}