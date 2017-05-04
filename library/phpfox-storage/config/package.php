<?php

namespace Phpfox\Storage {

    return [
        'storage.drivers' => [
            'local' => LocalFileStorage::class,
            'ftp'   => FtpFileStorage::class,
            'ssh2'  => Ssh2FileStorage::class,
        ],
        'services'        => [
            'storage.manager'   => [null, FileStorageManager::class],
            'storage.file_name' => [null, FileNameSupport::class],
            'storage.factory'   => null,
        ],
    ];
}