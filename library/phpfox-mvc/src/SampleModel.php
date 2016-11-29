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
        service('models')->delete('sample', $this->getId());
    }

    public function save()
    {
        service('models')->delete('sample', $this->getId());
    }
}