<?php

namespace Neutron\Like\Model;

return [
    'like' => [
        'table_factory',
        ':like',
        Like::class,
        'package/like/config/model/like.php',
    ],
];