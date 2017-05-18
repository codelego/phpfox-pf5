<?php

namespace Phpfox\Support;


class ResponseFactory
{
    /**
     * @ignore
     * @return Response
     */
    public function createFromHttpRequest()
    {
        $response = new Response();

        $request = _get('request');
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