<?php
namespace Phpfox\Form;

class BootstrapFormRender implements FormRenderInterface
{
    public function renderElements($form)
    {
        $fc = \Phpfox::get('form_render');

        $result = array_map(function (ElementInterface $v) use ($fc) {
            $name = $v->getName();
            $note = $v->getParam('note', '');
            if ($note) {
                $note = '<p class="help-block">' . $note . '</p>';
            }

            $label = $v->noLabel()
                ? ''
                : '<label>' . $v->getLabel()
                . '</label>';


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
        $string = $form->getParam('title');

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
    public function renderDesc($form)
    {
        $string = $form->getParam('desc');

        if (empty($string)) {
            return '';
        }

        return '<p class="form-desc">' . $string . '</p>';
    }

    public function renderButtons($form)
    {
        $array = [];
        $facade = \Phpfox::get('form_render');
        foreach ($form->getButtons() as $button) {
            $array[] = $facade->render($button);
        }

        if(empty($array))
            return '';

        return '<div class="form-group">'.implode('', $array) .'</div>';
    }

    /**
     * @param Form|Element $form
     *
     * @return string
     */
    public function render($form)
    {
        $errors = $form->getErrorHtml('alert');
        $desc = $this->renderDesc($form);
        $buttons = $this->renderButtons($form);
        $title = $this->renderTitle($form);
        $elements = $this->renderElements($form);

        if ($errors) {
            $desc = '';
        }

        return $form->open() . $title
            . $desc . $errors
            . $elements . $buttons
            . $form->close();
    }
}