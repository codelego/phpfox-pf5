<?php

namespace Neutron\Pages\Model;

return [
    'pages' => [
        'table_factory',
        ':pages',
        Pages::class,
        'package/pages/config/model/pages.php',
    ],
];