<?php

namespace Phpfox\Error;

class FormatAsAlert implements MessageFormatInterface
{
    public function format($messages)
    {
        if ($messages->isValid()) {
            return '';
        }

        $array = [];
        foreach ($messages->all() as $elements) {
            foreach ($elements as $string) {
                $array[] = $string;
            }
        }

        return '<div class="alert alert-danger form-errors">' . implode('<br/>', $array) . '</div>';
    }
}