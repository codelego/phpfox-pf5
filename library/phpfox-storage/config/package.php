<?php
namespace Phpfox\Storage {

    return [
        'psr4'            => [
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
            'storage.manager'   => [FileStorageManagerFactory::class],
            'storage.file_name' => [null, FileNameSupport::class],
            'storage.factory'   => null,
        ],
    ];
}