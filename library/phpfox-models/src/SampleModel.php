<?php

namespace Phpfox\Db;


class SampleModel
{
    protected $id;

    /**
     * @var bool
     */
    private $saved = false;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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