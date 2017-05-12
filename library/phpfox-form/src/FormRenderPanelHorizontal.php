<?php

namespace Phpfox\Form;

class FormRenderPanelHorizontal implements FormRenderInterface
{
    public function renderElements($form)
    {
        $fc = _service('form_render');

        $result = array_map(function (ElementInterface $v) use ($fc) {
            $name = $v->getName();
            $note = $v->getParam('note', '');
            if ($note) {
                $note = '<div class="control-note">' . $note . '</div>';
            }

            $info = $v->getParam('info', '');

            if ($info) {
                $info = '<div class="control-info">' . $info . '</div>';
            }

            $required = $v->isRequired() ? 'required' : '';

            if ($v->noWrap()) {
                return $fc->render($v);
            }

            $label = $v->noLabel()
                ? '<label class="control-label col-sm-3"></label>'
                : '<label class="control-label col-sm-3 ' . $required . '">' . $v->getLabel()
                . '</label>';

            return '<div class="form-group input-' . $name . '">' . $label
                . '<div class="col-sm-9">' . $info . $fc->render($v) . $note
                . '</div></div>';
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
        $form->setAttribute('class', 'form form-horizontal');
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