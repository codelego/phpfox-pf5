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
        static $id = 0;

        $facades = \Phpfox::get('form.render');

        $result = array_map(function (ElementInterface $v) use (
            $facades,
            &$id
        ) {
            $name = $v->getName();
            $label = $v->noLabel()
                ? ''
                : '<label for="_' . ($id++) . '">' . $v->getLabel()
                . '</label>';
            return '<div class="form-group input-' . $name . '">' . $label
                . $facades->render($v) . '</div>';
        }, $form->getElements());

        return $form->open() . implode(PHP_EOL, $result) . $form->close();
    }
}