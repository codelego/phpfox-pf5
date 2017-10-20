<?php

namespace Phpfox\Kernel;

interface ResponsePrototypeInterface
{
    /**
     * @param Response $response
     *
     * @return string
     */
    public function run(Response $response);

    /**
     * @param string $url
     * @param int    $code
     */
    public function redirect($url, $code);
}