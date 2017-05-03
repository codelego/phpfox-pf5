<?php

namespace Phpfox\Form;

return [
    'form_renders'  => [
        'input'                 => InputRender::class,
        'hidden'                => HiddenRender::class,
        'form_bootstrap'        => FormRenderBootstrap::class,
        'form_panel'            => FormRenderPanel::class,
        'form_panel_horizontal' => FormRenderPanelHorizontal::class,
        'button'                => ButtonRender::class,
        'checkbox'              => CheckboxRender::class,
        'select'                => SelectRender::class,
        'radio'                 => RadioRender::class,
        'file_upload'           => FileUploadRender::class,
        'textarea'              => TextareaRender::class,
        'yesno'                 => YesnoRender::class,
        'static_text'           => StaticTextRender::class,
    ],
    'form.elements' => [
        'yesno'        => YesnoField::class,
        'select'       => SelectField::class,
        'color_picker' => ColorPicker::class,
        'editor'       => Textarea::class,
        'choice'       => ChoiceField::class,
        'radio'        => RadioField::class,
        'checkbox'     => Checkbox::class,
        'select_multi' => MultiChoice::class,
        'button'       => Button::class,
        'static'       => StaticText::class,
        'file'         => InputFile::class,
        'text'         => TextField::class,
        'textarea'     => Textarea::class,
        'form'         => Form::class,
        'hidden'       => Hidden::class,
    ],
    'services'      => [
        'form_render'  => [null, FormFacades::class],
        'form.factory' => [null, FormFactory::class],
    ],
];
