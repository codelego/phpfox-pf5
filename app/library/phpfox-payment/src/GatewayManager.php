<?php

namespace Phpfox\Payments;

class GatewayManager
{

    /**
     * @param array $criteria
     *
     * @return string[]
     */
    public function filterBy($criteria)
    {
        if (!$criteria) {
            ;
        }
        return [];
    }
}