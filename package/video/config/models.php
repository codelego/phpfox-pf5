<?php
namespace Neutron\Video\Model;

return [
    'video'          => [
        'table_factory',
        ':video',
        Video::class,
        'video/config/.meta.video.php',
    ],
    'video_provider' => [
        'table_factory',
        ':video_provider',
        Provider::class,
        'video/config/.meta.video_provider.php',
    ],
    'video_category' => [
        'table_factory',
        ':video_category',
        Category::class,
        'video/config/.meta.video_category.php',
    ],
];