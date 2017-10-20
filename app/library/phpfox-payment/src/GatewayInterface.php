<?php

namespace Phpfox\Payments;


interface GatewayInterface
{
    /**
     * Get list off support currencies
     *
     * @return array
     */
    public function currencies();

    /**
     * Support recurring
     *
     * @return bool
     */
    public function recurring();

}