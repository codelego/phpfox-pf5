<?php

namespace Phpfox\Mvc;


class ResponseFactory
{
    /**
     * @ignore
     * @return Response
     */
    public function createFromHttpRequest()
    {
        return new Response();
    }

    /**
     * @return Response
     */
    public function factory()
    {
        return $this->createFromHttpRequest();
    }
}