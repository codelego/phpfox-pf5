<?php

namespace Phpfox\Db;


class SampleModel
{
    /**
     * @var bool
     */
    private $saved = false;

    /**
     * @var array
     */
    private $data = [];

    public function isSaved()
    {
        return $this->saved;
    }

    public function toArray()
    {
        return [];
    }

    public function exchangeArray($array)
    {
        $this->data = $array;
        return $this;
    }

    public function delete()
    {
        \Phpfox::get('models')->delete('sample', $this->getId());
    }

    public function save()
    {
        \Phpfox::get('models')->delete('sample', $this->getId());
    }
}