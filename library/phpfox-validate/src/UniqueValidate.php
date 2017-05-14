<?php

namespace Phpfox\Validate;

class UniqueValidate extends Validate
{
    public function isValid($value)
    {
        $key = $this->get('primary_key');
        $field = $this->get('unique_key');
        $accept = $this->get('accept', []);
        $table = $this->get('table');

        $row = _get('db')
            ->select($key)
            ->from($table)
            ->where($field . '=?', (string)$value)
            ->first();

        if (empty($row)) {
            return true;
        }

        $temp = $row[$key];

        if (is_array($accept)) {
            return in_array($temp, $accept);
        }
        return $temp == $accept;
    }
}