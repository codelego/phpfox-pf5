<?php

namespace Phpfox\Kernel;


class ResponseFactory
{
    /**
     * @ignore
     * @return Response
     */
    public function createFromHttpRequest()
    {
        $response = new Response();

        $request = \Phpfox::get('request');
        if ($request->isAjax()) {
            if ($request->isUpdateContainers()) {
                $response->setPrototype('response.update_containers');
            } elseif ($request->isUpdateContent()) {
                $response->setPrototype('response.update_content');
            } else {
                $response->setPrototype('response.ajax');
            }
        }

        return $response;
    }

    /**
     * @return Response
     */
    public function factory()
    {
        return $this->createFromHttpRequest();
    }
}