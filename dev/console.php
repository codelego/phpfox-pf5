<?php

include '../config/bootstrap.php';

echo json_encode([
    'basePath'   => PHPFOX_DIR . 'public',
    'baseUrl'    => PHPFOX_BASE_URL,
    'baseCdnUrl' => 'http:///example.max-cdn.com/',
]);