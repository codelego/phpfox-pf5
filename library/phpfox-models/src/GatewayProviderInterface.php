<?php

namespace Phpfox\Model;


interface GatewayProviderInterface
{
    /**
     * @param string $id
     *
     * @return array|null
     */
    public function get($id);
}