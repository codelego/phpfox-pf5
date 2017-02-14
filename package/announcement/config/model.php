<?php
namespace Neutron\Announcement\Model;

return [
    'announcement'         => [
        'table_factory',
        ':announcement',
        Announcement::class,
        'package/announcement/config/model/announcement.php',
    ],
    'announcement_exclude' => [
        'table_factory',
        ':announcement_exclude',
        AnnouncementExclude::class,
        'package/announcement/config/model/announcement_exclude.php',
    ],
];