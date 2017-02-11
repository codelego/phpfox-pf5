<?php

namespace Neutron\Event\Model;

return [
    'event' => [
        'table_factory',
        ':event',
        Event::class,
        'package/event/config/model/event.php',
    ],
];