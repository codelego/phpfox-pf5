<?php

return [
    'direction_id' => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.language' . '$$)->getDirectionIdOptions()$$$',
    ],
    'language_id'    => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.language' . '$$)->getLanguageIdOptions()$$$',
    ],
    'package_id'   => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.packages' . '$$)->getPackageIdOptions()$$$',
    ],
];