<?php

namespace Neutron\Invite\Model;

return [
    'invite' => [
        'table_factory',
        ':invite',
        Invite::class,
        'package/invite/config/model/invite.php',
    ],
];