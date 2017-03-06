<?php

define('PHPFOX_NO_CACHE', 1);

include __DIR__ . '/config/bootstrap.php';

register_shutdown_function(function () {
    if (null != ($error = error_get_last())) {
        echo json_encode($error, JSON_PRETTY_PRINT);
    }
});

Phpfox::get('session')->start();

Phpfox::get('dispatcher')->run();