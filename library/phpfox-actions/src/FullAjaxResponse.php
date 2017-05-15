<?php

namespace Phpfox\Action;


class FullAjaxResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        $jsonArray = [];

        $jsonArray['content'] = _get('layouts')
            ->prepare()
            ->setAjaxLoad(true)
            ->render();

        $jsonArray['meta'] = [
            'title'       => _get('html.title')->getContent(),
            'description' => _get('html.description')->getContent(),
            'keyword'     => _get('html.keyword')->getContent(),
        ];

        return json_encode($jsonArray);
    }

    public function redirect($url, $code)
    {
        exit(json_encode(['redirect' => $url]));
    }
}