<?php return array (
  'db.drivers' => 
  array (
    'mysqli' => 'Phpfox\\Mysqli\\MysqliAdapter',
  ),
  'job.handlers' => 
  array (
    'sample' => 'Phpfox\\Messaging\\SampleJobHandler',
  ),
  'log.container' => 
  array (
    'jobs.log' => 
    array (
      0 => 
      array (
        'driver' => 'filesystem',
        'filename' => 'jobs.log',
      ),
    ),
  ),
  'router.filters' => 
  array (
    '@profile' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Router\\ProfileNameFilter',
    ),
  ),
  'router.groups' => 
  array (
    '@admincp' => 
    array (
      'route' => '{admincp}',
      'defaults' => 
      array (
      ),
    ),
    '@rest' => 
    array (
      'route' => '{rest}',
      'defaults' => 
      array (
      ),
    ),
    '@ajax' => 
    array (
      'route' => '{ajax}',
    ),
    '@' => 
    array (
      'route' => '',
    ),
  ),
  'router.phrases' => 
  array (
  ),
  'router.routes' => 
  array (
  ),
  'session.drivers' => 
  array (
    'memcache' => 'Phpfox\\Memcache\\MemcacheSessionSaveHandler',
    'memcached' => 'Phpfox\\Memcache\\MemcachedSessionSaveHandler',
  ),
  'storage.drivers' => 
  array (
    'local' => 'Phpfox\\Storage\\LocalStorageService',
    'ftp' => 'Phpfox\\Storage\\FtpStorageService',
    'ssh2' => 'Phpfox\\Storage\\Ssh2StorageService',
  ),
  0 => 'html.title',
  'auth.adapters' => 
  array (
  ),
  'cache.adapters' => 
  array (
    'cache.filesystem' => 
    array (
      'driver' => 'filesystem',
    ),
    'cache.apc' => 
    array (
      'driver' => 'apc',
    ),
    'cache.apcu' => 
    array (
      'driver' => 'apcu',
    ),
    'cache.memcached' => 
    array (
      'driver' => 'memcached',
      'port' => 11211,
      'timeout' => 1,
      'persistent' => true,
      'retry_interval' => 15,
      'servers' => 
      array (
        0 => '127.0.0.1',
      ),
    ),
    'cache.memcache' => 
    array (
      'driver' => 'memcache',
      'port' => 11211,
      'timeout' => 1,
      'persistent' => true,
      'retry_interval' => 15,
      'servers' => 
      array (
        0 => '127.0.0.1',
      ),
    ),
  ),
  'cache.drivers' => 
  array (
    'filesystem' => 'Phpfox\\Cache\\FilesystemCacheStorage',
    'apc' => 'Phpfox\\Cache\\ApcCacheStorage',
    'apcu' => 'Phpfox\\Cache\\ApcuCacheStorage',
    'memcache' => 'Phpfox\\Memcache\\MemcacheCacheStorage',
    'memcached' => 'Phpfox\\Memcache\\MemcachedCacheStorage',
  ),
  'cache.map' => 
  array (
    'cache.local' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.filesystem',
    ),
    'cache.apc' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.apc',
    ),
    'cache.apcu' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.apcu',
    ),
    'cache' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.filesystem',
    ),
  ),
  'form.decorator' => 
  array (
    'button' => 'Phpfox\\Form\\Button',
    'checkbox' => 'Phpfox\\Form\\Checkbox',
    'multiCheckbox' => 'Phpfox\\Form\\MultiCheckbox',
    'colorPicker' => 'Phpfox\\Form\\ColorPicker',
    'editor' => 'Phpfox\\Form\\Editor',
    'file' => 'Phpfox\\Form\\FileUpload',
    'email' => 'Phpfox\\Form\\Email',
    'heading' => 'Phpfox\\Form\\Heading',
    'hidden' => 'Phpfox\\Form\\Hidden',
    'reset' => 'Phpfox\\Form\\Reset',
    'static' => 'Phpfox\\Form\\StaticText',
    'submit' => 'Phpfox\\Form\\Submit',
    'text' => 'Phpfox\\Form\\Text',
    'textarea' => 'Phpfox\\Form\\Textarea',
    'form' => 'Phpfox\\Form\\Form',
    'fieldset' => 'Phpfox\\Form\\Fieldset',
  ),
  'form.elements' => 
  array (
    'button' => 'Phpfox\\Form\\Button',
    'checkbox' => 'Phpfox\\Form\\Checkbox',
    'multiCheckbox' => 'Phpfox\\Form\\MultiCheckbox',
    'colorPicker' => 'Phpfox\\Form\\ColorPicker',
    'editor' => 'Phpfox\\Form\\Editor',
    'file' => 'Phpfox\\Form\\FileUpload',
    'email' => 'Phpfox\\Form\\Email',
    'heading' => 'Phpfox\\Form\\Heading',
    'hidden' => 'Phpfox\\Form\\Hidden',
    'reset' => 'Phpfox\\Form\\Reset',
    'static' => 'Phpfox\\Form\\StaticText',
    'submit' => 'Phpfox\\Form\\Submit',
    'text' => 'Phpfox\\Form\\Text',
    'textarea' => 'Phpfox\\Form\\Textarea',
    'form' => 'Phpfox\\Form\\Form',
    'fieldset' => 'Phpfox\\Form\\Fieldset',
  ),
  'log.containers' => 
  array (
    'log.auth' => 
    array (
    ),
    'main.log' => 
    array (
      0 => 
      array (
        'driver' => 'filesystem',
        'filename' => 'main.log',
      ),
    ),
  ),
  'log.drivers' => 
  array (
    'filesystem' => 'Phpfox\\Log\\FilesystemLogger',
    'db' => 'Phpfox\\Log\\DbLogger',
  ),
  'service.map' => 
  array (
    'auth' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Auth\\AuthManager',
    ),
    'log.auth' => 
    array (
      0 => 'Phpfox\\Log\\LogContainerFactory',
      1 => NULL,
      2 => 'log.auth',
    ),
    'cache.local' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.filesystem',
    ),
    'cache.apc' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.apc',
    ),
    'cache.apcu' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.apcu',
    ),
    'cache' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.filesystem',
    ),
    'db' => 
    array (
      0 => 'Phpfox\\Db\\AdapterFactory',
      1 => NULL,
      2 => 'default',
    ),
    'events' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Event\\EventManager',
    ),
    'html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HtmlFacades',
      2 => NULL,
    ),
    'breadcrumb' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\Breadcrumb',
    ),
    'require_js' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\RequireJs',
    ),
    'require_css' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\RequireCss',
    ),
    'html.title' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HeadTitle',
    ),
    'html.keyword' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HeadKeyword',
    ),
    'html.description' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HeadDescription',
    ),
    'html.meta' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HeadMeta',
    ),
    'html.open_graph' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HeadOpenGraph',
    ),
    'html.link' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\HeadLink',
    ),
    'html.start.style' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\ExternalStyle',
    ),
    'html.start.inline_style' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\InlineStyle',
    ),
    'html.start.script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\ExternalScript',
    ),
    'html.start.inline_script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\InlineScript',
    ),
    'html.start.static_html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\StaticHtml',
    ),
    'html.shutdown.script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\ExternalScript',
    ),
    'html.shutdown.inline_script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\InlineScript',
    ),
    'html.shutdown.static_html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Html\\StaticHtml',
    ),
    'translator' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\I18n\\Translator',
    ),
    'log.jobs' => 
    array (
      0 => 'Phpfox\\Log\\LogContainerFactory',
      1 => NULL,
    ),
    'queues' => 
    array (
      0 => NULL,
      1 => 'LocalQueueClass',
      2 => 'queues',
    ),
    'queues.01' => 
    array (
      0 => NULL,
      1 => 'AwsSQS',
      2 => 'queue.01',
    ),
    'main.log' => 
    array (
      0 => 'Phpfox\\Log\\LogContainerFactory',
      1 => NULL,
      2 => 'main.log',
    ),
    'mail' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mail\\MailService',
    ),
    'cache.memcache' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.memcache',
    ),
    'cache.memcached' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.memcached',
    ),
    'gateways' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Model\\GatewayManager',
    ),
    'responder' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mvc\\Responder',
    ),
    'requester' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mvc\\Requester',
    ),
    'app' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mvc\\Application',
    ),
    'views' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\View\\PhpTemplate',
    ),
    'models' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mvc\\GatewayManager',
    ),
    'router' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Router\\RouteManager',
    ),
    'router.filters' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Router\\FilterContainer',
    ),
    'session' => 
    array (
      0 => 'Phpfox\\Session\\SampleSessionFactory',
      1 => NULL,
      2 => NULL,
    ),
    'storage' => 
    array (
      0 => 'Phpfox\\Storage\\SampleStorageManagerFactory',
      1 => NULL,
      2 => NULL,
    ),
    'widgets' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Widget\\WidgetManager',
    ),
  ),
  1 => 'html.keyword',
  2 => 'html.description',
  3 => 'html.open_graph',
  4 => 'html.link',
  5 => 'html.meta',
  6 => 'html.start.style',
  7 => 'html.start.inline_style',
  8 => 'require_css',
);