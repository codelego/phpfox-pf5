<?php

return [
    'direction_id' => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.i18n' . '$$)->getDirectionIdOptions()$$$',
    ],
    'locale_id'    => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.i18n' . '$$)->getLocaleIdOptions()$$$',
    ],
    'package_id'   => [
        'factory' => 'select',
        'options' => '$$$_service($$' . 'core.packages' . '$$)->getPackageIdOptions()$$$',
    ],
];