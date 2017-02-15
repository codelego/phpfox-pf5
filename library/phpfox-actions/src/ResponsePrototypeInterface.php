<?php

namespace Phpfox\Action;

interface ResponsePrototypeInterface
{
    /**
     * @param Response $response
     *
     * @return string
     */
    public function run(Response $response);
}