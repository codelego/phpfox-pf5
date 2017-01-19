<?php

namespace Neutron\ThemeGalaxy;

return [
    'templates' => _get_view_map('galaxy@', 'theme-galaxy/view'),
    'services'  => [
        'theme_galaxy.callback' => [null, Service\EventListener::class,],
    ],
];