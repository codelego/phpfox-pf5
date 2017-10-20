<?php

namespace Phpfox\Storage {

    return [
        'storage_drivers' => [
            'local' => LocalStorage::class,
            'ftp'   => FtpStorage::class,
            'ssh2'  => Ssh2Storage::class,
        ],
        'services'        => [
            'storage'           => [null, StorageFacades::class],
            'storage.file_name' => [null, FileNameSupport::class],
        ],
    ];
}