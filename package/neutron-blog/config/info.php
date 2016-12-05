<?php

return [
    'psr4'      => [
        'Neutron\\Blog\\' => [
            'package/neutron-blog/src',
            'package/neutron-blog/test',
        ],
    ],
    'installer' => 'Neutron\\Blog\\Package',
    'paths'     => [
        'package/neutron-blog/src',
    ],
    'phrase'    => [],
    'roles'     => [],
    'pages'     => [],
];