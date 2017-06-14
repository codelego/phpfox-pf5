<?php

namespace Neutron\Pages\Model;

return [
    'pages'                => [
        'table_factory',
        ':pages',
        Pages::class,
        'package/pages/config/model/pages.php',
    ],
    'pages_level' => [
        'table_factory',
        ':pages_level',
        PagesLevel::class,
        'package/pages/config/model/pages_level.php',
    ],
    'pages_member'         => [
        'table_factory',
        ':pages_member',
        PagesMember::class,
        'package/pages/config/model/pages_member.php',
    ],
    'pages_member_item'    => [
        'table_factory',
        ':pages_member_item',
        PagesMemberItem::class,
        'package/pages/config/model/pages_member_item.php',
    ],
    'pages_member_list'    => [
        'table_factory',
        ':pages_member_list',
        PagesMemberList::class,
        'package/pages/config/model/pages_member_list.php',
    ],
    'pages_member_request' => [
        'table_factory',
        ':pages_member_request',
        PagesMemberRequest::class,
        'package/pages/config/model/pages_member_request.php',
    ],
];