<?php

namespace Neutron\Photo\Controller;

return [
    'photo.index'          => IndexController::class,
    'photo.admin-photo'    => AdminPhotoController::class,
    'photo.admin-album'    => AdminAlbumController::class,
    'photo.admin-category' => AdminCategoryController::class,
    'photo.admin-settings' => AdminSettingsController::class,
];