<?php

namespace Neutron\Event\Model;

return [
    'event'                => [
        'table_factory',
        ':event',
        Event::class,
        'package/event/config/model/event.php',
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