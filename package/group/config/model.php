<?php

namespace Neutron\Group\Model;

return [
    'group'                => [
        'table_factory',
        ':group',
        Group::class,
        'package/group/config/model/group.php',
    ],
    'group_member'         => [
        'table_factory',
        ':group_member',
        GroupMember::class,
        'package/group/config/model/group_member.php',
    ],
    'group_member_list'    => [
        'table_factory',
        ':group_member_list',
        GroupMemberList::class,
        'package/group/config/model/group_member_list.php',
    ],
    'group_member_item'    => [
        'table_factory',
        ':group_member_item',
        GroupMemberItem::class,
        'package/group/config/model/group_member_item.php',
    ],
    'group_member_request' => [
        'table_factory',
        ':group_member_request',
        GroupMemberRequest::class,
        'package/group/config/model/group_member_request.php',
    ],
];