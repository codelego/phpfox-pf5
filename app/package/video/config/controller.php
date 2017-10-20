<?php

namespace Neutron\Video\Controller;

return [
    'video.index'          => IndexController::class,
    'video.admin-video'    => AdminVideoController::class,
    'video.admin-category' => AdminCategoryController::class,
    'video.admin-provider' => AdminProviderController::class,
    'video.admin-encoder'  => AdminEncoderController::class,
    'video.admin-settings' => AdminSettingsController::class,
];