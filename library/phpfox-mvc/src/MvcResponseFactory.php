<?php

namespace Phpfox\Mvc;


class MvcResponseFactory
{
    /**
     * @ignore
     * @return MvcResponse
     */
    public function createFromHttpRequest()
    {
        return new MvcResponse();
    }

    /**
     * @return MvcResponse
     */
    public function factory()
    {
        return $this->createFromHttpRequest();
    }
}