<?php return array (
  'Phpfox\\Realm' => 
  array (
    0 => 'library/phpfox-realm/src',
    1 => 'library/phpfox-realm/test',
  ),
  'auth.adapters' => 
  array (
  ),
  'cache.adapters' => 
  array (
    'cache.files' => 
    array (
      'driver' => 'filesystem',
    ),
    'cache.apc' => 
    array (
      'driver' => 'apc',
    ),
  ),
  'cache.drivers' => 
  array (
    'filesystem' => 'Phpfox\\Cache\\FilesCacheStorage',
    'apc' => 'Phpfox\\Cache\\ApcuCacheStorage',
  ),
  'cache.map' => 
  array (
    'cache.local' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.files',
    ),
    'cache.apc' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.apc',
    ),
    'cache' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.files',
    ),
  ),
  'db.drivers' => 
  array (
    'mysqli' => 'Phpfox\\Mysqli\\MysqliDbAdapter',
  ),
  'form.elements' => 
  array (
    'yesno' => 'Phpfox\\Form\\YesnoField',
    'color_picker' => 'Phpfox\\Form\\ColorPicker',
    'editor' => 'Phpfox\\Form\\Textarea',
    'choice' => 'Phpfox\\Form\\Choice',
    'checkbox' => 'Phpfox\\Form\\Checkbox',
    'select_multi' => 'Phpfox\\Form\\MultiChoice',
    'button' => 'Phpfox\\Form\\Button',
    'static' => 'Phpfox\\Form\\StaticText',
    'file' => 'Phpfox\\Form\\InputFile',
    'text' => 'Phpfox\\Form\\TextField',
    'textarea' => 'Phpfox\\Form\\Textarea',
    'form' => 'Phpfox\\Form\\Form',
    'hidden' => 'Phpfox\\Form\\Hidden',
  ),
  'form.renders' => 
  array (
    'input' => 'Phpfox\\Form\\InputRender',
    'form_bootstrap' => 'Phpfox\\Form\\FormBootstrapRender',
    'button' => 'Phpfox\\Form\\ButtonRender',
    'checkbox' => 'Phpfox\\Form\\CheckboxRender',
    'select' => 'Phpfox\\Form\\SelectRender',
    'radio' => 'Phpfox\\Form\\RadioRender',
    'file_upload' => 'Phpfox\\Form\\FileUploadRender',
    'textarea' => 'Phpfox\\Form\\TextareaRender',
    'yesno' => 'Phpfox\\Form\\YesnoRender',
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
  'log.containers' => 
  array (
    'log.auth' => 
    array (
    ),
    'main.log' => 
    array (
      0 => 
      array (
        'driver' => 'files',
        'filename' => 'main.log',
      ),
    ),
    'dev.log' => 
    array (
      0 => 
      array (
        'driver' => 'files',
        'filename' => 'dev.log',
      ),
    ),
  ),
  'log.drivers' => 
  array (
    'files' => 'Phpfox\\Logger\\FilesLogger',
    'db' => 'Phpfox\\Logger\\DbLogger',
  ),
  'mailer.transports' => 
  array (
    'smtp' => 'Phpfox\\Mailer\\SmtpMailTransport',
    'system' => 'Phpfox\\Mailer\\SystemMailTransport',
  ),
  'navigation.decorators' => 
  array (
    'navbar' => 'Phpfox\\Navigation\\NavbarDecorator',
    'nav' => 'Phpfox\\Navigation\\NavDecorator',
  ),
  'services' => 
  array (
    'mvc.dispatch' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\Dispatcher',
    ),
    'mvc.request' => 
    array (
      0 => 'Phpfox\\Action\\RequestFactory',
      1 => NULL,
    ),
    'mvc.response' => 
    array (
      0 => 'Phpfox\\Action\\ResponseFactory',
      1 => NULL,
    ),
    'mvc.response.ajax' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\AjaxResponse',
    ),
    'mvc.response.html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\HtmlResponse',
    ),
    'assets' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\AssetsFacades',
      2 => NULL,
    ),
    'breadcrumb' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\Breadcrumb',
    ),
    'require_js' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\RequireJs',
    ),
    'require_css' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\RequireCss',
    ),
    'html.title' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\HeadTitle',
    ),
    'html.keyword' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\HeadKeyword',
    ),
    'html.description' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\HeadDescription',
    ),
    'html.meta' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\HeadMeta',
    ),
    'html.open_graph' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\HeadOpenGraph',
    ),
    'html.link' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\HeadLink',
    ),
    'html.start.style' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\ExternalStyle',
    ),
    'html.start.inline_style' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\InlineStyle',
    ),
    'html.start.script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\ExternalScript',
    ),
    'html.start.inline_script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\InlineScript',
    ),
    'html.start.static_html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\StaticHtml',
    ),
    'html.shutdown.script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\ExternalScript',
    ),
    'html.shutdown.inline_script' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\InlineScript',
    ),
    'html.shutdown.static_html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\StaticHtml',
    ),
    'auth' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Authentication\\AuthFacades',
    ),
    'auth.factory' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Authentication\\AuthFactoryInterface',
    ),
    'auth.log' => 
    array (
      0 => 'Phpfox\\Logger\\LogContainerFactory',
      1 => NULL,
      2 => 'log.auth',
    ),
    'auth.storage' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Authentication\\AuthStorageSession',
    ),
    'authorization' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Authorization\\AuthorizationManager',
    ),
    'authorization.provider' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Authorization\\PermissionProviderInterface',
    ),
    'cache.local' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.files',
    ),
    'cache.apc' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.apc',
    ),
    'cache' => 
    array (
      0 => 'Phpfox\\Cache\\CacheStorageFactory',
      1 => NULL,
      2 => 'cache.files',
    ),
    'curl' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\CurlRequest\\CurlFactory',
    ),
    'db' => 
    array (
      0 => 'Phpfox\\Db\\DbAdapterFactory',
      1 => NULL,
      2 => 'default',
    ),
    'table_factory' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Db\\DbTableGatewayFactory',
    ),
    'mvc.events' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Event\\EventManager',
    ),
    'mvc.events.loader' => NULL,
    'form.render' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Form\\FormFacades',
    ),
    'form.factory' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Form\\FormFactory',
    ),
    'translator' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\I18n\\Translator',
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
      0 => 'Phpfox\\Logger\\LogContainerFactory',
      1 => NULL,
      2 => 'main.log',
    ),
    'dev.log' => 
    array (
      0 => 'Phpfox\\Logger\\LogContainerFactory',
      1 => NULL,
      2 => 'dev.log',
    ),
    'mailer' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mailer\\MailFacades',
    ),
    'mailer.factory' => NULL,
    'models' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Model\\GatewayManager',
    ),
    'navigation' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Navigation\\NavigationManager',
    ),
    'package' => 'Phpfox\\Package\\PackageManager',
    'package.loader' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Package\\PackageLoader',
    ),
    'controller.provider' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Package\\ActionProvider',
    ),
    'models.provider' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Package\\ModelProvider',
    ),
    'router.provider' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Package\\RouterProvider',
    ),
    'router' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Routing\\Router',
    ),
    'session' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Session\\SessionManager',
    ),
    'session.save_handler' => NULL,
    'storage.manager' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Storage\\FileStorageManager',
    ),
    'storage.file_name' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Storage\\FileNameSupport',
    ),
    'storage.factory' => NULL,
    'image' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Support\\InterventionImageManager',
    ),
    'view.template' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\View\\PhpTemplate',
    ),
    'view.layout' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\View\\ViewLayout',
    ),
    'widgets' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Widget\\WidgetManager',
    ),
  ),
  'session.drivers' => 
  array (
    'files' => 'Phpfox\\Session\\FilesSession',
    'redis' => 'Phpfox\\Session\\RedisSession',
    'memcache' => 'Phpfox\\Session\\MemcacheSession',
  ),
  'storage.drivers' => 
  array (
    'local' => 'Phpfox\\Storage\\LocalFileStorage',
    'ftp' => 'Phpfox\\Storage\\FtpFileStorage',
    'ssh2' => 'Phpfox\\Storage\\Ssh2FileStorage',
  ),
);