<?php

namespace Neutron\Video\Controller;

return [
    'video.index'          => IndexController::class,
    'video.admin-video'    => AdminVideoController::class,
    'video.admin-category' => AdminCategoryController::class,
    'video.admin-acl'      => AdminAclController::class,
    'video.admin-settings' => AdminSettingsController::class,
    'video.admin-utility'  => AdminUtilityController::class,
];