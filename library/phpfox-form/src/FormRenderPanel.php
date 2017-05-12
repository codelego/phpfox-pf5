<?php

namespace Phpfox\Form;

class FormRenderPanel implements FormRenderInterface
{
    public function renderElements($form)
    {
        $fc = _service('form_render');

        $result = array_map(function (ElementInterface $v) use ($fc) {
            $name = $v->getName();
            $note = $v->getParam('note', '');
            if ($note) {
                $note = '<p class="control-note">' . $note . '</p>';
            }

            $info = $v->getParam('note', '');
            if ($info) {
                $info = '<p class="control-info">' . $info . '</p>';
            }

            $required = $v->isRequired() ? 'required' : '';

            $label = $v->noLabel()
                ? ''
                : '<label class="control-label ' . $required . '">' . $v->getLabel() . '</label>';


            if ($v->noWrap()) {
                return $fc->render($v);
            }

            return '<div class="form-group input-' . $name . '">' . $label
                . $info . $fc->render($v) . $note.'</div>';
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

        return '<p class="form-desc">' . $string . '</p>';
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

        return '<div class="panel-footer">' . implode('', $array) . '</div>';
    }

    /**
     * @param Form|Element $form
     *
     * @return string
     */
    public function render($form)
    {
        return $form->open() .
            '<div class="panel panel-default">'
            . $this->renderTitle($form)
            . '<div class="panel-body">'
            . $this->renderInfo($form)
            . $form->getErrorHtml('alert')
            . $this->renderElements($form)
            . '</div>'
            . $this->renderButtons($form)
            . '</div>'
            . $form->close();
    }
}