<?php

namespace Phpfox\Support;

class EventResponse implements \ArrayAccess, \Countable, \Iterator
{

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var int
     */
    private $position = 0;

    /**
     * Convenient access to the first handler return value.
     *
     * @return mixed The first handler return value
     */
    public function first()
    {

        if (count($this->data) == 0) {
            return null;
        }
        return $this->data[0];
    }

    /**
     * Convenient access to the last handler return value.
     *
     * If the collection is empty, returns null. Otherwise, returns value
     * returned by last handler.
     *
     * @return mixed The last handler return value
     */
    public function last()
    {
        if (count($this->data) == 0) {
            return null;
        }

        return $this->data[count($this->data) - 1];

    }

    /**
     * Check if any of the responses match the given value.
     *
     * @param  mixed $value The value to look for among responses
     *
     * @return bool
     */
    public function contains($value)
    {
        foreach ($this->data as $item) {
            if ($item === $value) {
                return true;
            }
        }
        return false;
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function count()
    {
        return count($this->data);
    }

    public function current()
    {
        return $this->data[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return array_key_exists($this->position, $this->data);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function push($value)
    {
        array_push($this->data, $value);
    }
}
