<?php

namespace Neutron\Group;

return [
    'services' => [
        'group.callback'       => [null, Service\EventListener::class],
        'group.profile_filter' => [null, Service\ProfileNameFilter::class],
    ],
];