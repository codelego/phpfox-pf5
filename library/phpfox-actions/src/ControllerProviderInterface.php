<?php

namespace Phpfox\Action;


interface ControllerProviderInterface
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id);
}