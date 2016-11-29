<?php

namespace Phpfox\Messaging;

interface JobHandlerInterface
{
    /**
     * Handle job
     */
    public function handle();
}