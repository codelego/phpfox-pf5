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
    'select' => 'Phpfox\\Form\\SelectField',
    'color_picker' => 'Phpfox\\Form\\ColorPicker',
    'editor' => 'Phpfox\\Form\\Textarea',
    'choice' => 'Phpfox\\Form\\ChoiceField',
    'radio' => 'Phpfox\\Form\\RadioField',
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
  'form_renders' => 
  array (
      'input' => 'Phpfox\\Form\\InputRender',
      'form_bootstrap' => 'Phpfox\\Form\\FormRenderBootstrap',
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
    'aside' => 'Phpfox\\Navigation\\AsideDecorator',
  ),
  'services' => 
  array (
    'dispatcher' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\Dispatcher',
    ),
    'request' => 
    array (
      0 => 'Phpfox\\Action\\RequestFactory',
      1 => NULL,
    ),
    'response' => 
    array (
      0 => 'Phpfox\\Action\\ResponseFactory',
      1 => NULL,
    ),
    'response.ajax' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\AjaxResponse',
    ),
    'response.html' => 
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
      1 => 'Neutron\\User\\Service\\AuthFactory',
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
      1 => 'Neutron\\Core\\Service\\PermissionProvider',
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
    'error_formater' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Error\\MessageFormater',
    ),
    'mvc.events' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Event\\EventManager',
    ),
    'mvc.events.loader' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\EventLoader',
    ),
    'form_render' => 
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
    'layouts' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Layout\\LayoutManager',
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
    'error.handler' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Logger\\ErrorHandler',
    ),
    'mailer' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Mailer\\MailFacades',
    ),
    'mailer.factory' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\MailTransportFactory',
    ),
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
    'menu.primary' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => NULL,
    ),
    'menu.secondary' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => NULL,
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
    'session.save_handler' => 
    array (
      0 => 'Neutron\\Core\\Service\\SessionFactory',
    ),
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
    'storage.factory' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\FileStorageFactory',
    ),
    'image' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Support\\InterventionImageManager',
    ),
    'registry' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Support\\Registry',
    ),
    'validator' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Validate\\ValidateManager',
    ),
    'template' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\View\\PhpTemplate',
    ),
    'i18n.loader' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\I18nMessageLoader',
    ),
    'core.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\EventListener',
    ),
    'navigation.loader' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\NavigationLoader',
    ),
    'core.i18n_language' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\I18nLanguage',
    ),
    'core.packages' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\Packages',
    ),
    'core.themes' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\ThemeManager',
    ),
    'core.roles' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\Roles',
    ),
    'layout_loader' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\LayoutLoader',
    ),
    'user.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\User\\Service\\EventListener',
    ),
    'user.verify_email' => 
    array (
      0 => NULL,
      1 => 'Neutron\\User\\Service\\VerifyTokenManager',
    ),
    'user.browse' => 
    array (
      0 => NULL,
      1 => 'Neutron\\User\\Service\\UserBrowse',
    ),
    'user.profile_filter' => 
    array (
      0 => NULL,
      1 => 'Neutron\\User\\Service\\ProfileNameFilter',
    ),
    'user.auth_history' => 
    array (
      0 => NULL,
      1 => 'Neutron\\User\\Service\\AuthHistoryManager',
    ),
    'message.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Message\\Service\\EventListener',
    ),
    'blog.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Blog\\Service\\EventListener',
    ),
    'blog_category' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Blog\\Service\\BlogCategoryManager',
    ),
    'pages.callback' => 'Neutron\\Pages\\Service\\EventListener',
    'pages.browse' => 'Neutron\\Pages\\Service\\Browse',
    'pages.profile_filter' => 'Neutron\\Pages\\Service\\ProfileNameFilter',
    'cms.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Cms\\Service\\EventListener',
    ),
    'group.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Group\\Service\\EventListener',
    ),
    'group.profile_filter' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Group\\Service\\ProfileNameFilter',
    ),
    'event.profile_filter' => 'Neutron\\Event\\Service\\ProfileNameFilter',
    'photo.callback' => 'Neutron\\Photo\\Service\\EventListener',
    'photo' => 'Neutron\\Photo\\Service\\photo',
    'video.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Video\\Service\\EventListener',
    ),
    'video' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Video\\Service\\video',
    ),
    'video.provider' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Video\\Service\\ProviderManager',
    ),
    'contact_us' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Contact\\Service\\ContactUs',
    ),
    'reports' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Report\\Service\\ReportManager',
    ),
    'announcements' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Announcement\\Service\\AnnouncementManager',
    ),
    'friends' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Friend\\Service\\FriendManager',
    ),
    'links' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Link\\Service\\LinkManager',
    ),
  ),
  'session.drivers' => 
  array (
    'files' => 'Phpfox\\Session\\FilesSession',
    'redis' => 'Phpfox\\Session\\RedisSession',
    'memcache' => 'Phpfox\\Session\\MemcacheSession',
    'database' => 'Neutron\\Core\\Service\\DatabaseSession',
  ),
  'storage.drivers' => 
  array (
    'local' => 'Phpfox\\Storage\\LocalFileStorage',
    'ftp' => 'Phpfox\\Storage\\FtpFileStorage',
    'ssh2' => 'Phpfox\\Storage\\Ssh2FileStorage',
  ),
  'validator_rules' => 
  array (
    'required' => 'Phpfox\\Validate\\RequiredValidate',
    'string' => 'Phpfox\\Validate\\StringValidate',
    'email' => 'Phpfox\\Validate\\EmailAddressValidate',
    'int' => 'Phpfox\\Validate\\IntegerValidate',
    'ip' => 'Phpfox\\Validate\\IpValidate',
    'url' => 'Phpfox\\Validate\\UrlValidate',
    'callback' => 'Phpfox\\Validate\\CallbackValidate',
    'unique' => 'Phpfox\\Validate\\UniqueValidate',
  ),
  'db.adapters' => 
  array (
    'default' => 
    array (
      'driver' => 'mysqli',
      'host' => '127.0.0.1',
      'port' => 3306,
      'user' => 'root',
      'password' => 'namnv123',
      'database' => 'phpfox_v5',
    ),
  ),
  'requirejs.paths' => 
  array (
    'jquery' => 'jscript/jquery/jquery',
    'bootstrap' => 'jscript/bootstrap/bootstrap',
    'jqueryui' => 'jscript/jquery-ui/jqueryui',
    'underscore' => 'jscript/underscore/underscore.min',
    'tiny_mce' => 'jscript/tinymce/jquery.tinymce.min',
    'main' => 'package/core/main',
  ),
  'static.js' => 
  array (
    'require' => 'jscript/requirejs/require.js',
  ),
  'static.css' => 
  array (
    'main' => '@css/main.css',
    'font' => '//fonts.googleapis.com/css?family=Roboto',
    'custom' => '@css/custom.css',
    'admin.login' => '@css/admin-login.css',
    'core-test.css' => '@css/core-test.css',
  ),
  'requirejs.shim' => 
  array (
    'bootstrap' => 
    array (
      'deps' => 
      array (
        0 => 'jquery',
      ),
      'exports' => 'bootstrap',
    ),
    'jqueryui' => 
    array (
      'deps' => 
      array (
        0 => 'jquery',
      ),
      'exports' => 'jqueryui',
    ),
    'underscore' => 
    array (
      'deps' => 
      array (
        0 => 'jquery',
      ),
      'exports' => '_',
    ),
  ),
  'templates' => 
  array (
    'default:core/admin-authorization/index' => 'package/core/view/admin-authorization/index',
    'default:core/admin-i18n/index' => 'package/core/view/admin-i18n/index',
    'default:core/admin-i18n/phrases' => 'package/core/view/admin-i18n/phrases',
    'default:core/admin-index/index' => 'package/core/view/admin-index/index',
    'default:core/admin-mail/add-transport' => 'package/core/view/admin-mail/add-transport',
    'default:core/admin-mail/index' => 'package/core/view/admin-mail/index',
    'default:core/admin-mail/menu' => 'package/core/view/admin-mail/menu',
    'default:core/admin-mail/transports' => 'package/core/view/admin-mail/transports',
    'default:core/admin-package/index' => 'package/core/view/admin-package/index',
    'default:core/admin-settings/index' => 'package/core/view/admin-settings/index',
    'default:core/admin-status/health-check' => 'package/core/view/admin-status/health-check',
    'default:core/admin-status/overview' => 'package/core/view/admin-status/overview',
    'default:core/admin-status/statistics' => 'package/core/view/admin-status/statistics',
    'default:core/admin-theme/debug' => 'package/core/view/admin-theme/debug',
    'default:core/admin-theme/index' => 'package/core/view/admin-theme/index',
    'default:core/block/admin-information' => 'package/core/view/block/admin-information',
    'default:core/block/admin-update' => 'package/core/view/block/admin-update',
    'default:core/error/404' => 'package/core/view/error/404',
    'default:core/error/500' => 'package/core/view/error/500',
    'default:core/error/503' => 'package/core/view/error/503',
    'default:core/error/index' => 'package/core/view/error/index',
    'default:core/index/index' => 'package/core/view/index/index',
    'default:layout/default' => 'package/core/layout/default/default',
    'default:layout/footer' => 'package/core/layout/default/footer',
    'default:layout/form-edit' => 'package/core/layout/default/form-edit',
    'default:layout/header' => 'package/core/layout/default/header',
    'default:grid/simple' => 'package/core/layout/grid/simple',
    'admin:layout/breadcrumb' => 'package/core/layout/admin/breadcrumb',
    'admin:layout/default' => 'package/core/layout/admin/default',
    'admin:layout/form-edit' => 'package/core/layout/admin/form-edit',
    'admin:layout/login' => 'package/core/layout/admin/login',
    'default:user/admin-manage/index' => 'package/user/view/admin-manage/index',
    'default:user/auth/login' => 'package/user/view/auth/login',
    'default:user/auth/logout' => 'package/user/view/auth/logout',
    'default:user/profile/index' => 'package/user/view/profile/index',
    'default:user/register/index' => 'package/user/view/register/index',
    'default:user/settings/index' => 'package/user/view/settings/index',
    'default:user/settings/login-history' => 'package/user/view/settings/login-history',
    'default:blog/admin-category/index' => 'package/blog/view/admin-category/index',
    'default:blog/admin-category/menu' => 'package/blog/view/admin-category/menu',
    'default:blog/index/index' => 'package/blog/view/index/index',
    'default:video/index/embed' => 'package/video/view/index/embed',
    'default:video/index/index' => 'package/video/view/index/index',
    'default:video/partial/embed' => 'package/video/view/partial/embed',
    'default:contact/admin-department/index' => 'package/contact/view/admin-department/index',
    'default:contact/index/index' => 'package/contact/view/index/index',
    'default:report/admin-category/index' => 'package/report/view/admin-category/index',
  ),
  'auth.passwords' => 
  array (
    'pf5' => 'Neutron\\User\\Auth\\Pf5PasswordCompatible',
    'pf4' => 'Neutron\\User\\Auth\\Pf4PasswordCompatible',
    'se' => 'Neutron\\User\\Auth\\SePasswordCompatible',
    'ow' => 'Neutron\\User\\Auth\\OwPasswordCompatible',
  ),
  'view.map' => 
  array (
  ),
  'themes' => 
  array (
    'default' => 
    array (
    ),
  ),
  'views' => 
  array (
  ),
);