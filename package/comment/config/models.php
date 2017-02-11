<?php

namespace Neutron\Comment\Model;

return [
    'comment' => [
        'table_factory',
        ':comment',
        Comment::class,
        'package/comment/config/model/comment.php',
    ],
];