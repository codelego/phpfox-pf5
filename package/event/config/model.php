<?php

namespace Neutron\Event\Model;

return [
    'event'                => [
        'table_factory',
        ':event',
        Event::class,
        'package/event/config/model/event.php',
    ],
    'event_category'       => [
        'table_factory',
        ':event_category',
        EventCategory::class,
        'package/event/config/model/event_category.php',
    ],
    'event_level'          => [
        'table_factory',
        ':event_level',
        EventLevel::class,
        'package/event/config/model/event_level.php',
    ],
    'event_member'         => [
        'table_factory',
        ':event_member',
        EventMember::class,
        'package/event/config/model/event_member.php',
    ],
    'event_member_item'    => [
        'table_factory',
        ':event_member_item',
        EventMemberItem::class,
        'package/event/config/model/event_member_item.php',
    ],
    'event_member_list'    => [
        'table_factory',
        ':event_member_list',
        EventMemberList::class,
        'package/event/config/model/event_member_list.php',
    ],
    'event_member_request' => [
        'table_factory',
        ':event_member_request',
        EventMemberRequest::class,
        'package/event/config/model/event_member_request.php',
    ],
];