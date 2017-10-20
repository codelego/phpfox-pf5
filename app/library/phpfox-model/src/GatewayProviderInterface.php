<?php

namespace Phpfox\Model;


interface GatewayProviderInterface
{
    /**
     * Get parameter of model by id
     *
     * @param string $id
     *
     * @return array|null
     */
    public function getModelParameter($id);

    /**
     * Get all model parameters
     *
     * @return array
     */
    public function getModelParameters();
}