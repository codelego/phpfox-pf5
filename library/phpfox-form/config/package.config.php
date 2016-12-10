<?php

namespace Phpfox\Form {

    return [
        'psr4'          => [
            'Phpfox\\Form\\' => [
                'library/phpfox-form/src',
                'library/phpfox-form/test',
            ],
        ],
        'form.renders'  => [
            'input'          => InputRender::class,
            'form_bootstrap' => FormBootstrapRender::class,
            'button'         => ButtonRender::class,
            'checkbox'       => CheckboxRender::class,
        ],
        'form.elements' => [
            'color_picker' => ColorPicker::class,
            'editor'       => Textarea::class,
            'checkbox'     => Checkbox::class,
            'select_multi' => MultiChoice::class,
            'button'       => Button::class,
            'static'       => StaticText::class,
            'file'         => InputFile::class,
            'text'         => Text::class,
            'textarea'     => Textarea::class,
            'form'         => Form::class,
        ],
        'services'   => [
            'form.render'  => [null, FormFacades::class],
            'form.factory' => [null, FormFactory::class],
        ],
    ];
}