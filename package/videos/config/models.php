<?php
namespace Neutron\Video\Model;

return [
    'video'          => [
        'table_factory',
        ':video',
        Video::class,
        'videos/config/.meta.video.php',
    ],
    'video_provider' => [
        'table_factory',
        ':video_provider',
        VideoProvider::class,
        'videos/config/.meta.video_provider.php',
    ],
    'video_category' => [
        'table_factory',
        ':video_category',
        VideoCategory::class,
        'videos/config/.meta.video_category.php',
    ],
];