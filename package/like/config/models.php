<?php

namespace Neutron\Like\Model;

return [
    'like' => [
        'table_factory',
        ':like',
        Like::class,
        'like/config/.meta.like.php',
    ],
];