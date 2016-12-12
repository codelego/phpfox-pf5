<?php

namespace Phpfox\Mvc;


interface ControllerProviderInterface
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id);
}