<?php

namespace Phpfox\Action;


use Phpfox\View\ViewModel;

class ContentAjaxResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        $data = $response->getData();

        if ($data instanceof ViewModel) {
            $data = $data->render();
        } elseif (!is_string($data)) {
            $data = json_encode($data);
        }

        return json_encode(['content' => $data]);
    }

    public function redirect($url, $code)
    {
        exit(json_encode(['redirect' => $url]));
    }
}