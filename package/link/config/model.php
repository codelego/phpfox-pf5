<?php

namespace Neutron\Link\Model;

return [
    'link' => [
        'table_factory',
        ':link',
        Link::class,
        'package/link/config/model/link.php',
    ],
];