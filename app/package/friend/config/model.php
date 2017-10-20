<?php

namespace Neutron\Friend\Model;

return [
    'friend'         => [
        'table_factory',
        ':friend',
        Friend::class,
        'package/friend/config/model/friend.php',
    ],
    'friend_forward' => [
        'table_factory',
        ':friend_forward',
        FriendForward::class,
        'package/friend/config/model/forward.php',
    ],
    'friend_list'    => [
        'table_factory',
        ':friend_list',
        FriendList::class,
        'package/friend/config/model/list.php',
    ],
    'friend_item'    => [
        'table_factory',
        ':friend_item',
        FriendItem::class,
        'package/friend/config/model/item.php',
    ],
    'friend_request' => [
        'table_factory',
        ':friend_request',
        FriendRequest::class,
        'package/friend/config/model/request.php',
    ],
];