<?php

namespace Phpfox\Error;

class MessageContainer
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Clear messages by key
     *
     * @param string $group
     */
    public function delete($group)
    {
        unset($this->data[$group]);
    }

    /**
     * Clear all messages
     */
    public function flush()
    {
        $this->data = [];
    }

    /**
     * Get message by key
     *
     * @param string $group
     *
     * @return array
     */
    public function get($group)
    {
        return isset($this->data[$group]) ? $this->data[$group] : [];
    }

    /**
     * @param string $group
     * @param array  $messages
     */
    public function set($group, $messages)
    {
        $this->data[$group] = $messages;
    }

    /**
     * @param string $group
     * @param string $message
     */
    public function add($group, $message)
    {
        $this->data[$group][] = $message;
    }

    /**
     * @param string $group
     *
     * @return bool
     */
    public function has($group)
    {
        return isset($this->data[$group]);
    }

    /**
     * Get all messages
     *
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return empty($this->data);
    }

    /**
     * Get formatted html string
     *
     * @param string|null $type
     *
     * @return string
     */
    public function getHtml($type = null)
    {
        if (empty($this->data)) {
            return '';
        }

        return _get('error_formater')->format($this, $type);
    }
}