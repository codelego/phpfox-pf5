<?php

namespace Neutron\ThemeGalaxy;

return [
    'templates' => _view_map([
        'galaxy' => ['layout' => 'package/theme-galaxy/layout'],
    ]),
    'services'  => [
        'theme_galaxy.callback' => [null, Service\EventListener::class,],
    ],
];