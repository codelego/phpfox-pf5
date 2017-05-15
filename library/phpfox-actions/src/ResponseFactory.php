<?php

namespace Phpfox\Action;


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
            if ($request->get('fal')) {
                $response->setPrototype('response.ajax_push_state');
            }else{

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