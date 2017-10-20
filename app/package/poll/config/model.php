<?php

namespace Neutron\Poll\Model;

return [
    'poll_category' => [
        'table_factory',
        ':poll_category',
        PollCategory::class,
        'package/poll/config/model/poll_category.php',
    ],
];