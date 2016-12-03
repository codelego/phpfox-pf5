<?php
namespace Phpfox\Storage {

    return [
        'psr4'   => [
            'Phpfox\\Storage\\' => [
                'library/phpfox-storage/src',
                'library/phpfox-storage/test',
            ],
        ],
        'storage.drivers' => [
            'local' => LocalFileStorage::class,
            'ftp'   => FtpFileStorage::class,
            'ssh2'  => Ssh2FileStorage::class,
        ],
        'service.map'     => [
            'file_storage' => [FileStorageManagerFactory::class, null, null],
        ],
    ];
}