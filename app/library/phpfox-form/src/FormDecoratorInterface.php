<?php

namespace Phpfox\Form;

interface FormDecoratorInterface extends DecoratorInterface
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
    public function renderInfo($form);
}