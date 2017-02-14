<?php
namespace Neutron\Messages\Model;

return [
    'messages' => [
        'table_factory',
        ':messages',
        Messages::class,
        'package/messages/config/model/messages.php',
    ],
];