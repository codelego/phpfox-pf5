<?php
namespace Neutron\Video\Model;

return [
    'video'          => [
        'table_factory',
        ':video',
        Video::class,
        'package/video/config/model/video.php',
    ],
    'video_provider' => [
        'table_factory',
        ':video_provider',
        VideoProvider::class,
        'package/video/config/model/video_provider.php',
    ],
    'video_category' => [
        'table_factory',
        ':video_category',
        VideoCategory::class,
        'package/video/config/model/video_category.php',
    ],
];