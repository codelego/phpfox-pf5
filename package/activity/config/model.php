<?php

namespace Neutron\Activity\Model;

return [
    'feed' => [
        'table_factory',
        ':activity_feed',
        Feed::class,
        'package/activity/config/model/feed.php',
    ],
];