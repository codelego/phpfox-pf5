<?php

namespace Phpfox\Action;

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
}