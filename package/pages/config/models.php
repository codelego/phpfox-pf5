<?php

namespace Neutron\Pages\Model;

return [
    'pages' => [
        'table_factory',
        ':pages',
        Pages::class,
        'pages/config/.meta.pages.php',
    ],
];