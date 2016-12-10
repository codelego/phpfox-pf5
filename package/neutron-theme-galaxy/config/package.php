<?php

namespace Neutron\ThemeGalaxy;

return [
    'views.map'   => _get_view_map('galaxy@', 'neutron-theme-galaxy/view'),
    'services' => [
        'theme_galaxy.callback' => [null, EventListener::class,],
    ],
];