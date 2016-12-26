<?php

namespace Phpfox\Action;


class ActionResponseFactory
{
    /**
     * @ignore
     * @return ActionResponse
     */
    public function createFromHttpRequest()
    {
        return new ActionResponse();
    }

    /**
     * @return ActionResponse
     */
    public function factory()
    {
        return $this->createFromHttpRequest();
    }
}