<?php
namespace {
    return [
        'auth.adapters'   => [],
        'cache.adapters'  => [
            'cache.filesystem' => [
                'driver' => 'filesystem',
            ],
            'cache.apc'        => [
                'driver' => 'apc',
            ],
            'cache.apcu'       => [
                'driver' => 'apcu',
            ],
            'cache.memcached'  => [
                'driver'         => 'memcached',
                'port'           => 11211,
                'timeout'        => 1,
                'persistent'     => true,
                'retry_interval' => 15,
                'servers'        => [
                    0 => '127.0.0.1',
                ],
            ],
            'cache.memcache'   => [
                'driver'         => 'memcache',
                'port'           => 11211,
                'timeout'        => 1,
                'persistent'     => true,
                'retry_interval' => 15,
                'servers'        => [
                    0 => '127.0.0.1',
                ],
            ],
        ],
        'cache.drivers'   => [
            'filesystem' => 'Phpfox\\Cache\\FilesystemCacheStorage',
            'apc'        => 'Phpfox\\Cache\\ApcCacheStorage',
            'apcu'       => 'Phpfox\\Cache\\ApcuCacheStorage',
            'memcache'   => 'Phpfox\\Memcache\\MemcacheCacheStorage',
            'memcached'  => 'Phpfox\\Memcache\\MemcachedCacheStorage',
        ],
        'db.drivers'      => [
            'mysqli' => 'Phpfox\\Mysqli\\MysqliAdapter',
        ],
        'events'          => [
            'requireJs' => [
                0 => 'onAssetManagerGetHeader',
                1 => 'onAssetManagerGetFooter',
            ],
        ],
        'form.decorator'  => [
            'button'        => 'Phpfox\\Form\\Button',
            'checkbox'      => 'Phpfox\\Form\\Checkbox',
            'multiCheckbox' => 'Phpfox\\Form\\MultiCheckbox',
            'colorPicker'   => 'Phpfox\\Form\\ColorPicker',
            'editor'        => 'Phpfox\\Form\\Editor',
            'file'          => 'Phpfox\\Form\\FileUpload',
            'email'         => 'Phpfox\\Form\\Email',
            'heading'       => 'Phpfox\\Form\\Heading',
            'hidden'        => 'Phpfox\\Form\\Hidden',
            'reset'         => 'Phpfox\\Form\\Reset',
            'static'        => 'Phpfox\\Form\\StaticText',
            'submit'        => 'Phpfox\\Form\\Submit',
            'text'          => 'Phpfox\\Form\\Text',
            'textarea'      => 'Phpfox\\Form\\Textarea',
            'form'          => 'Phpfox\\Form\\Form',
            'fieldset'      => 'Phpfox\\Form\\Fieldset',
        ],
        'form.elements'   => [
            'button'        => 'Phpfox\\Form\\Button',
            'checkbox'      => 'Phpfox\\Form\\Checkbox',
            'multiCheckbox' => 'Phpfox\\Form\\MultiCheckbox',
            'colorPicker'   => 'Phpfox\\Form\\ColorPicker',
            'editor'        => 'Phpfox\\Form\\Editor',
            'file'          => 'Phpfox\\Form\\FileUpload',
            'email'         => 'Phpfox\\Form\\Email',
            'heading'       => 'Phpfox\\Form\\Heading',
            'hidden'        => 'Phpfox\\Form\\Hidden',
            'reset'         => 'Phpfox\\Form\\Reset',
            'static'        => 'Phpfox\\Form\\StaticText',
            'submit'        => 'Phpfox\\Form\\Submit',
            'text'          => 'Phpfox\\Form\\Text',
            'textarea'      => 'Phpfox\\Form\\Textarea',
            'form'          => 'Phpfox\\Form\\Form',
            'fieldset'      => 'Phpfox\\Form\\Fieldset',
        ],
        'html.container'  => [
            'title'           => [
                0 => null,
                1 => 'Phpfox\\Html\\HeadTitle',
            ],
            'headKeyword'     => [
                0 => null,
                1 => 'Phpfox\\Html\\HeadKeyword',
            ],
            'headMeta'        => [
                0 => null,
                1 => 'Phpfox\\Html\\HeadMeta',
            ],
            'openGraph'       => [
                0 => null,
                1 => 'Phpfox\\Html\\HeadOpenGraph',
            ],
            'links'           => [
                0 => null,
                1 => 'Phpfox\\Html\\HeadLink',
            ],
            'styles'          => [
                0 => null,
                1 => 'Phpfox\\Html\\ExternalStyle',
            ],
            'inlineStyles'    => [
                0 => null,
                1 => 'Phpfox\\Html\\InlineStyle',
            ],
            'script'          => [
                0 => null,
                1 => 'Phpfox\\Html\\ExternalScript',
            ],
            'startScript'     => [
                0 => null,
                1 => 'Phpfox\\Html\\InlineScript',
            ],
            'bootHtml'        => [
                0 => null,
                1 => 'Phpfox\\Html\\StaticHtml',
            ],
            'shutdownScripts' => [
                0 => null,
                1 => 'Phpfox\\Html\\InlineScript',
            ],
            'breadcrumb'      => [
                0 => null,
                1 => 'Phpfox\\Html\\Breadcrumb',
            ],
        ],
        'job.handlers'    => [
            'sample' => 'Phpfox\\Messaging\\SampleJobHandler',
        ],
        'log.container'   => [
            'jobs.log' => [
                0 => [
                    'driver'   => 'filesystem',
                    'filename' => 'jobs.log',
                ],
            ],
        ],
        'log.containers'  => [
            'log.auth' => [],
            'log.main' => [
                0 => [
                    'driver'   => 'filesystem',
                    'filename' => 'main.log',
                ],
            ],
        ],
        'log.drivers'     => [
            'filesystem' => 'Phpfox\\Log\\FilesystemLogger',
            'db'         => 'Phpfox\\Log\\DbLogger',
        ],
        'router.filters'  => [
            '@profile' => [
                0 => null,
                1 => 'Phpfox\\Router\\ProfileNameFilter',
            ],
        ],
        'router.phrases'  => [],
        'router.routes'   => [],
        'service.map'     => [
            'auth'            => [
                0 => null,
                1 => 'Phpfox\\Auth\\AuthManager',
            ],
            'log.auth'        => [
                0 => 'Phpfox\\Log\\LogContainerFactory',
                1 => null,
                2 => 'log.auth',
            ],
            'cache.local'     => [
                0 => 'Phpfox\\Cache\\CacheStorageFactory',
                1 => null,
                2 => 'cache.filesystem',
            ],
            'cache.apc'       => [
                0 => 'Phpfox\\Cache\\CacheStorageFactory',
                1 => null,
                2 => 'cache.apc',
            ],
            'cache.apcu'      => [
                0 => 'Phpfox\\Cache\\CacheStorageFactory',
                1 => null,
                2 => 'cache.apcu',
            ],
            'cache'           => [
                0 => 'Phpfox\\Cache\\CacheStorageFactory',
                1 => null,
                2 => 'cache.filesystem',
            ],
            'configs'         => [
                0 => null,
                1 => 'Phpfox\\Config\\ConfigManager',
            ],
            'db'              => [
                0 => 'Phpfox\\Db\\AdapterFactory',
                1 => null,
                2 => 'default',
            ],
            'events'          => [
                0 => null,
                1 => 'Phpfox\\EventManager\\EventManager',
            ],
            'html'            => [
                0 => null,
                1 => 'Phpfox\\Html\\HtmlFacades',
                2 => null,
            ],
            'translator'      => [
                0 => null,
                1 => 'Phpfox\\I18n\\Translator',
            ],
            'log.main'        => [
                0 => 'Phpfox\\Log\\LogContainerFactory',
                1 => null,
                2 => 'log.main',
            ],
            'mail'            => [
                0 => null,
                1 => 'Phpfox\\Mail\\MailService',
            ],
            'cache.memcache'  => [
                0 => 'Phpfox\\Cache\\CacheStorageFactory',
                1 => null,
                2 => 'cache.memcache',
            ],
            'cache.memcached' => [
                0 => 'Phpfox\\Cache\\CacheStorageFactory',
                1 => null,
                2 => 'cache.memcached',
            ],
            'log.jobs'        => [
                0 => 'Phpfox\\Log\\LogContainerFactory',
                1 => null,
            ],
            'queues'          => [
                0 => null,
                1 => 'LocalQueueClass',
                2 => 'queues',
            ],
            'queues.01'       => [
                0 => null,
                1 => 'AwsSQS',
                2 => 'queue.01',
            ],
            'models'          => [
                0 => null,
                1 => 'Phpfox\\Model\\GatewayManager',
            ],
            'responder'       => [
                0 => null,
                1 => 'Phpfox\\Mvc\\Responder',
            ],
            'requester'       => [
                0 => null,
                1 => 'Phpfox\\Mvc\\Requester',
            ],
            'app'             => [
                0 => null,
                1 => 'Phpfox\\Mvc\\Application',
            ],
            'requireJs'       => [
                0 => null,
                1 => 'Phpfox\\RequireJs\\RequireJs',
            ],
            'router'          => [
                0 => null,
                1 => 'Phpfox\\Router\\RouteContainer',
            ],
            'router.filters'  => [
                0 => null,
                1 => 'Phpfox\\Router\\FilterContainer',
            ],
            'serviceManager'  => [
                0 => null,
                1 => 'Phpfox\\Service\\ServiceContainer',
            ],
            'session'         => [
                0 => 'Phpfox\\Session\\SampleSessionFactory',
                1 => null,
                2 => null,
            ],
            'storage'         => [
                0 => 'Phpfox\\Storage\\SampleStorageManagerFactory',
                1 => null,
                2 => null,
            ],
            'renderer'        => [
                0 => null,
                1 => 'Phpfox\\View\\PhpTemplate',
            ],
            'layout'          => [
                0 => null,
                1 => 'Phpfox\\View\\ViewLayout',
            ],
            'widgets'         => [
                0 => null,
                1 => 'Phpfox\\Widget\\WidgetManager',
            ],
        ],
        'session.drivers' => [
            'memcache'  => 'Phpfox\\Memcache\\MemcacheSessionSaveHandler',
            'memcached' => 'Phpfox\\Memcache\\MemcachedSessionSaveHandler',
        ],
        'storage.drivers' => [
            'local' => 'Phpfox\\Storage\\LocalStorageService',
            'ftp'   => 'Phpfox\\Storage\\FtpStorageService',
            'ssh2'  => 'Phpfox\\Storage\\Ssh2StorageService',
        ],
    ];
}