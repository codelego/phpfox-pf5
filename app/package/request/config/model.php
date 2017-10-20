<?php

namespace Neutron\Request\Model;

return [
    'request'         => [
        'table_factory',
        ':request',
        Request::class,
        'package/request/config/model/request.php',
    ],
    'request_type'    => [
        'table_factory',
        ':request_type',
        RequestType::class,
        'package/request/config/model/request_type.php',
    ],
    'request_setting' => [
        'table_factory',
        ':request_setting',
        RequestSetting::class,
        'package/request/config/model/request_setting.php',
    ],
];