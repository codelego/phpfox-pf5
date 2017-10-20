<?php

namespace Phpfox\Kernel;


class UpdateContainersResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        $jsonArray = [];

        $jsonArray['content'] = \Phpfox::get('layouts')
            ->prepare()
            ->setAjaxLoad(true)
            ->render();

        $jsonArray['meta'] = [
            'title'       => \Phpfox::get('html.title')->getContent(),
            'description' => \Phpfox::get('html.description')->getContent(),
            'keyword'     => \Phpfox::get('html.keyword')->getContent(),
        ];

        return json_encode($jsonArray);
    }

    public function redirect($url, $code)
    {
        exit(json_encode(['redirect' => $url]));
    }
}