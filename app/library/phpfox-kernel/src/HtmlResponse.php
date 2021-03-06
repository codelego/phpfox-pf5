<?php

namespace Phpfox\Kernel;

class HtmlResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        \Phpfox::trigger('onResponderTerminate', null);

        if (PHPFOX_UNIT_TEST == false and function_exists('ob_get_level')) {
            while (ob_get_level()) {
                ob_get_clean();
            }
        }

        return \Phpfox::get('layouts')->prepare()->render();
    }

    public function redirect($url, $code)
    {
        if (!headers_sent()) {
            http_response_code($code);
            header('location: ' . $url);
        }
        exit;
    }
}