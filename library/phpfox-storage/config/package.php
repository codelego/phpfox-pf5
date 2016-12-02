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
            'local' => StorageAdapterLocal::class,
            'ftp'   => StorageAdapterFtp::class,
            'ssh2'  => StorageAdapterSsh2::class,
        ],
        'service.map'     => [
            'storage' => [StorageManagerFactory::class, null, null],
        ],
    ];
}