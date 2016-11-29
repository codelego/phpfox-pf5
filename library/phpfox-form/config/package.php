<?php

namespace Phpfox\Form {

    return [
        'autoload.psr4' => [
            'Phpfox\\Form\\' => [
                'library\phpfox-form\src',
                'library\phpfox-form\test',
            ],
        ],
        'form.decorator' => [
            'button'        => Button::class,
            'checkbox'      => Checkbox::class,
            'multiCheckbox' => MultiCheckbox::class,
            'colorPicker'   => ColorPicker::class,
            'editor'        => Editor::class,
            'file'          => FileUpload::class,
            'email'         => Email::class,
            'heading'       => Heading::class,
            'hidden'        => Hidden::class,
            'reset'         => Reset::class,
            'static'        => StaticText::class,
            'submit'        => Submit::class,
            'text'          => Text::class,
            'textarea'      => Textarea::class,
            'form'          => Form::class,
            'fieldset'      => Fieldset::class,
        ],
        'form.elements'  => [
            'button'        => Button::class,
            'checkbox'      => Checkbox::class,
            'multiCheckbox' => MultiCheckbox::class,
            'colorPicker'   => ColorPicker::class,
            'editor'        => Editor::class,
            'file'          => FileUpload::class,
            'email'         => Email::class,
            'heading'       => Heading::class,
            'hidden'        => Hidden::class,
            'reset'         => Reset::class,
            'static'        => StaticText::class,
            'submit'        => Submit::class,
            'text'          => Text::class,
            'textarea'      => Textarea::class,
            'form'          => Form::class,
            'fieldset'      => Fieldset::class,
        ],
    ];
}
