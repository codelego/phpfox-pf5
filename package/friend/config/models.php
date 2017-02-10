<?php

namespace Neutron\Friend\Model;

return [
    'friend'         => [
        'table_factory',
        ':friend',
        Friend::class,
        'friend/config/.meta.friend.php',
    ],
    'friend_forward' => [
        'table_factory',
        ':friend_forward',
        FriendForward::class,
        'friend/config/.meta.forward.php',
    ],
    'friend_list'    => [
        'table_factory',
        ':friend_list',
        FriendList::class,
        'friend/config/.meta.list.php',
    ],
    'friend_item'    => [
        'table_factory',
        ':friend_item',
        FriendItem::class,
        'friend/config/.meta.item.php',
    ],
    'friend_request' => [
        'table_factory',
        ':friend_request',
        FriendRequest::class,
        'friend/config/.meta.request.php',
    ],
];