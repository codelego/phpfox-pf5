<?php
namespace Phpfox\Storage {

    return [
        'autoload.psr4'   => [
            'Phpfox\\Storage\\' => [
                'library/phpfox-storage/src',
                'library/phpfox-storage/test',
            ],
        ],
        'storage.drivers' => [
            'local' => LocalStorageService::class,
            'ftp'   => FtpStorageService::class,
            'ssh2'  => Ssh2StorageService::class,
        ],
        'service.map'     => [
            'storage' => [SampleStorageManagerFactory::class, null, null],
        ],
    ];
}