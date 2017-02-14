<?php

namespace Neutron\Photo\Model;

return [
    'photo_category' => [
        'table_factory',
        ':photo_category',
        PhotoCategory::class,
        'package/photo/config/model/photo_category.php',
    ],
];