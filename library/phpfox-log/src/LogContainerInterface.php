<?php
namespace Phpfox\Log;


/**
 * Class LogContainer
 *
 * @package Phpfox\Log
 */
interface LogContainerInterface extends LoggerInterface
{
    /**
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function add(LoggerInterface $logger);


}