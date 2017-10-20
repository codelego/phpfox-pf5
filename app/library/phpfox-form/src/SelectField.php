<?php

namespace Phpfox\Form;

class SelectField extends ChoiceField
{
    protected $attributes = ['class' => 'form-control',];

    protected $decorator = 'select';
}