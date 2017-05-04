<?php

namespace Phpfox\Logger;


interface LogContainerInterface extends LoggerInterface
{
    /**
     * @param LoggerInterface $logger
     */
    public function add(LoggerInterface $logger);
}