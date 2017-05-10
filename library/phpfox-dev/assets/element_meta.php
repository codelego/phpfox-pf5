<?php

return [
    'direction_id' => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.locale' . '$$)->getDirectionIdOptions()$$$',
    ],
    'locale_id'    => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.locale' . '$$)->getLocaleIdOptions()$$$',
    ],
    'package_id'   => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.packages' . '$$)->getPackageIdOptions()$$$',
    ],
];