<?php

namespace Neutron\Announcement;

return [
    'services' => [
        'announcements' => [null, Service\Announcements::class],
    ],
    'views'    => _view_map(['default' => ['announcement' => 'package/announcement/view']]),
];