<?php

return [
    'direction_id' => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.language' . '$$)->getDirectionIdOptions()$$$',
    ],
    'locale_id'    => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.language' . '$$)->getLocaleIdOptions()$$$',
    ],
    'package_id'   => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.packages' . '$$)->getPackageIdOptions()$$$',
    ],
];