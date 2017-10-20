<?php

namespace Phpfox\Form;

class YesnoField extends ChoiceField
{
    protected $decorator = 'radio';

    protected $params = ['inline' => true];

    protected function initialize()
    {
        if (empty($this->options)) {
            $this->options = [
                ['label' => _text('Yes'), 'value' => 1],
                ['label' => _text('No'), 'value' => 0],
            ];
        }
    }
}