<?php

namespace Phpfox\Action;

class HtmlResponse implements ResponsePrototypeInterface
{
    public function run(Response $response)
    {
        _emit('onResponderTerminate', null);

        if (PHPFOX_UNIT_TEST == false and function_exists('ob_get_level')) {
            while (ob_get_level()) {
                ob_get_clean();
            }
        }

        echo \Phpfox::get('view.layout')->prepare()->render();
    }
}