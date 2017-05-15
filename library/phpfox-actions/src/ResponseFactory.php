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
        $requestType = $request->getHeader('RequestType');
        if ($request->isAjax()) {
            if ($requestType == PHPFOX_FULL_AJAX_LOAD) {
                $response->setPrototype('response.load_full_ajax');
            } elseif ($requestType == PHPFOX_CONTENT_AJAX_LOAD) {
                $response->setPrototype('response.load_content_ajax');
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