<?php
namespace Phpfox\Mvc;

/**
 * Interface ConfigInterface
 *
 * @package Phpfox\Config
 */
interface ConfigManagerInterface
{
    /**
     * Extend configure using merge recursive
     *
     * @param array $data
     *
     * @return $this
     */
    public function extend($data);

    /**
     * @param string $key
     * @param null   $item
     *
     * @return mixed
     */
    public function get($key, $item = null);

    /**
     * @param string $key
     * @param array  $data
     *
     * @return $this
     */
    public function set($key, $data);
}