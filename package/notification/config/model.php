<?php

namespace Neutron\Notification\Model;

return [
    'notification'         => [
        'table_factory',
        ':notification',
        Notification::class,
        'package/notification/config/model/notification.php',
    ],
    'notification_type'    => [
        'table_factory',
        ':notification_type',
        NotificationType::class,
        'package/notification/config/model/notification_type.php',
    ],
    'notification_setting' => [
        'table_factory',
        ':notification_setting',
        NotificationSetting::class,
        'package/notification/config/model/notification_setting.php',
    ],
];