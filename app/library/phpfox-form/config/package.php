<?php

namespace Phpfox\Form;

return [
    'form_renders'  => [
        'input'                 => InputDecorator::class,
        'form_bootstrap'        => FormRenderBootstrap::class,
        'form_panel'            => FormRenderPanel::class,
        'form_panel_horizontal' => FormRenderPanelHorizontal::class,
        'form_panel_flat'       => FormRenderPanelFlat::class,
        'button'                => ButtonDecorator::class,
        'checkbox'              => CheckboxDecorator::class,
        'select'                => SelectDecorator::class,
        'radio'                 => InputRadioDecorator::class,
        'file_upload'           => FileUploadDecorator::class,
        'textarea'              => TextareaDecorator::class,
        'static_text'           => StaticDecorator::class,
        'multi_checkbox'        => MultiCheckboxDecorator::class,
        'multi_select'          => MultiSelectDecorator::class,
    ],
    'form.elements' => [
        'yesno'          => YesnoField::class,
        'select'         => SelectField::class,
        'password'       => InputPasswordField::class,
        'color_picker'   => ColorPicker::class,
        'editor'         => TextareaField::class,
        'choice'         => ChoiceField::class,
        'radio'          => InputRadioField::class,
        'checkbox'       => CheckboxField::class,
        'multi_checkbox' => MultiCheckboxField::class,
        'multi_select'   => MultiSelectField::class,
        'button'         => ButtonField::class,
        'static'         => StaticField::class,
        'file'           => InputFileField::class,
        'text'           => InputTextField::class,
        'textarea'       => TextareaField::class,
        'form'           => Form::class,
        'hidden'         => InputHiddenField::class,
    ],
    'services'      => [
        'form_render'  => [null, FormFacades::class],
        'form.factory' => [null, FormFactory::class],
    ],
];
