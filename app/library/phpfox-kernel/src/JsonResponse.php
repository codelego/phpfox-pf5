<?php

namespace Phpfox\Kernel;

use Phpfox\View\ViewModel;

class JsonResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        $data = $response->getData();

        if (is_string($data)) {
            return $data;
        }

        if ($data instanceof ViewModel) {
            return $data->render();
        }

        return json_encode($data);
    }

    public function redirect($url, $code)
    {
        exit(json_encode(['redirect' => $url]));
    }
}