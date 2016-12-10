<?php

namespace Neutron\ThemeGalaxy;

return [
    'templates' => _get_view_map('galaxy@', 'neutron-theme-galaxy/view'),
    'services'  => [
        'theme_galaxy.callback' => [null, Service\EventListener::class,],
    ],
];