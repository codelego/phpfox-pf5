<?php

namespace Neutron\Announcement;

return [
    'services' => [
        'announcement' => [null, Service\announcement::class],
    ],
    'views'    => _view_map(['default' => ['announcement' => 'package/announcement/view']]),
];