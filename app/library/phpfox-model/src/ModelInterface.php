<?php

namespace Phpfox\Model;

/**
 * Interface ModelInterface
 *
 * @package Phpfox\Model
 */
interface ModelInterface extends \ArrayAccess
{
    /**
     * @return string
     * Return the model id map,
     * etc: user, blog, video_category, pages, event.
     */
    public function getModelId();

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return array
     */
    public function getChanged();

    /**
     * Update data from array
     *
     * @param $array
     *
     * @return $this
     */
    public function exchangeArray($array);

    /**
     * @return bool
     * @throws GatewayException
     */
    public function delete();

    /**
     * @return $this
     * @throws GatewayException
     */
    public function save();

    /**
     * @return $this
     */
    public function markSaved();

    /**
     * @param array|mixed $data
     */
    public function fromArray($data);

    /**
     * @return bool
     */
    public function isSaved();

    /**
     * Magic get method
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name);

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value);
}