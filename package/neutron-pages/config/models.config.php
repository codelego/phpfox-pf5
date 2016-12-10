<?php

namespace Neutron\Pages;

return [
    'pages' => [
        'table_factory',
        ':pages',
        Model\Pages::class,
        'neutron-pages/config/.meta.pages.php',
    ],
];