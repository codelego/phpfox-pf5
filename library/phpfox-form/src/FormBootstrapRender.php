<?php
namespace Phpfox\Form;

class FormBootstrapRender implements RenderInterface
{
    /**
     * @param Form $form
     *
     * @return string
     */
    public function render($form)
    {
        $fc = \Phpfox::get('form.render');

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
}