<?php

namespace Neutron\Pages\Model;

return [
    'pages' => [
        'table_factory',
        ':pages',
        Pages::class,
        'neutron-pages/config/.meta.pages.php',
    ],
];