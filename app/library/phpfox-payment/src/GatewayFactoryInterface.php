<?php

namespace Phpfox\Payments;


interface GatewayFactoryInterface
{
    /**
     * @param string $id
     *
     * @return PaymentMethodInterface
     */
    public function factory($id);
}