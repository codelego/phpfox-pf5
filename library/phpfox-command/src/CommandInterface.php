<?php

namespace Phpfox\Command;

interface CommandInterface
{
    /**
     * @param array $params
     *
     * @return mixed
     */
    public function execute($params);
}