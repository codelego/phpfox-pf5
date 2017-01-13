<?php

namespace Phpfox\Action;


interface ActionProviderInterface
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id);
}