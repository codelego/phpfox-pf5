<?php

namespace Neutron\Dev\Model;

return [
    'dev_action_meta' => [
        'table_factory',
        ':dev_action_meta',
        DevActionMeta::class,
        'package/dev/config/model/dev_action_meta.php',
    ],
    'dev_table_meta'  => [
        'table_factory',
        ':dev_table_meta',
        DevTableMeta::class,
        'package/dev/config/model/dev_table_meta.php',
    ],
];

