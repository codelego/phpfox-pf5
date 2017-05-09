<?php

namespace Phpfox\Form;

class FormRenderBootstrap implements FormRenderInterface
{
    public function renderElements($form)
    {
        $fc = _service('form_render');

        $result = array_map(function (ElementInterface $v) use ($fc) {
            $name = $v->getName();
            $note = $v->getParam('note', '');
            if ($note) {
                $note = '<p class="help-block">' . $note . '</p>';
            }

            $required = $v->isRequired() ? 'required' : '';

            $label = $v->noLabel()
                ? ''
                : '<label class="control-label ' . $required . '">' . $v->getLabel()
                . '</label>';

            if ($v->noWrap()) {
                return $fc->render($v);
            }

            return '<div class="form-group input-' . $name . '">' . $label
                . $note . $fc->render($v) . '</div>';
        }, $form->getElements());

        return implode(PHP_EOL, $result);
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

        return '<div class="form-title">' . $string . '</div>';
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

        return '<p class="form-info">' . $string . '</p>';
    }

    public function renderButtons($form)
    {
        $array = [];
        $facade = _service('form_render');
        foreach ($form->getButtons() as $button) {
            $array[] = $facade->render($button);
        }

        if (empty($array)) {
            return '';
        }

        return '<div class="form-group">' . implode('', $array) . '</div>';
    }

    /**
     * @param Form|Element $form
     *
     * @return string
     */
    public function render($form)
    {
        return $form->open() .
            $this->renderTitle($form)
            . $this->renderInfo($form)
            . $form->getErrorHtml('alert')
            . $this->renderElements($form)
            . $this->renderButtons($form)
            . $form->close();
    }
}