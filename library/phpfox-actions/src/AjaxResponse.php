<?php
namespace Phpfox\Action;

class AjaxResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        $data = $response->getData();
        echo json_encode($data);
        exit;
    }
}