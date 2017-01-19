<?php

namespace Neutron\Pages;


return [
    'services' => [
        'pages.callback'       => Service\EventListener::class,
        'pages.browse'         => Service\Browse::class,
        'pages.profile_filter' => Service\ProfileNameFilter::class,
    ],
];