<?php

namespace Phpfox\Error;

class FormatAsList implements MessageFormatInterface
{
    public function format($messages)
    {
        if ($messages->isValid()) {
            return '';
        }

        $array = [];
        foreach ($messages->all() as $elements) {
            foreach ($elements as $string) {
                $array[] = '<li>' . $string . '</li>';
            }
        }

        return '<ul class="errors">' . implode(PHP_EOL, $array) . '</ul>';
    }
}