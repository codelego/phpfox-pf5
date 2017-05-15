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
    'password' => 'Phpfox\\Form\\InputPasswordField',
    'color_picker' => 'Phpfox\\Form\\ColorPicker',
    'editor' => 'Phpfox\\Form\\TextareaField',
    'choice' => 'Phpfox\\Form\\ChoiceField',
    'radio' => 'Phpfox\\Form\\InputRadioField',
    'checkbox' => 'Phpfox\\Form\\CheckboxField',
    'multi_checkbox' => 'Phpfox\\Form\\MultiCheckboxField',
    'multi_select' => 'Phpfox\\Form\\MultiSelectField',
    'button' => 'Phpfox\\Form\\ButtonField',
    'static' => 'Phpfox\\Form\\StaticField',
    'file' => 'Phpfox\\Form\\InputFileField',
    'text' => 'Phpfox\\Form\\InputTextField',
    'textarea' => 'Phpfox\\Form\\TextareaField',
    'form' => 'Phpfox\\Form\\Form',
    'hidden' => 'Phpfox\\Form\\InputHiddenField',
  ),
  'form_renders' => 
  array (
    'input' => 'Phpfox\\Form\\InputDecorator',
    'form_bootstrap' => 'Phpfox\\Form\\FormRenderBootstrap',
    'form_panel' => 'Phpfox\\Form\\FormRenderPanel',
    'form_panel_horizontal' => 'Phpfox\\Form\\FormRenderPanelHorizontal',
    'form_panel_flat' => 'Phpfox\\Form\\FormRenderPanelFlat',
    'button' => 'Phpfox\\Form\\ButtonDecorator',
    'checkbox' => 'Phpfox\\Form\\CheckboxDecorator',
    'select' => 'Phpfox\\Form\\SelectDecorator',
    'radio' => 'Phpfox\\Form\\InputRadioDecorator',
    'file_upload' => 'Phpfox\\Form\\FileUploadDecorator',
    'textarea' => 'Phpfox\\Form\\TextareaDecorator',
    'static_text' => 'Phpfox\\Form\\StaticDecorator',
    'multi_checkbox' => 'Phpfox\\Form\\MultiCheckboxDecorator',
    'multi_select' => 'Phpfox\\Form\\MultiSelectDecorator',
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
    'mail.log' => 
    array (
      0 => 
      array (
        'driver' => 'files',
        'filename' => 'mail.log',
      ),
    ),
    'debug.log' => 
    array (
      0 => 
      array (
        'driver' => 'files',
        'filename' => 'debug.log',
      ),
    ),
  ),
  'log.drivers' => 
  array (
    'files' => 'Phpfox\\Logger\\FilesLogger',
    'db' => 'Phpfox\\Logger\\DbLogger',
  ),
  'mail.drivers' => 
  array (
    'smtp' => 'Phpfox\\Mailer\\SmtpAdapter',
    'system' => 'Phpfox\\Mailer\\SystemAdapter',
  ),
  'navigation.decorators' => 
  array (
    'navbar' => 'Phpfox\\Navigation\\NavbarDecorator',
    'nav' => 'Phpfox\\Navigation\\NavDecorator',
    'aside' => 'Phpfox\\Navigation\\AsideDecorator',
    'toolbar' => 'Phpfox\\Navigation\\ToolbarDecorator',
  ),
  'pagination.decorators' => 
  array (
    'default' => 'Phpfox\\Paging\\SlidingDecorator',
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
      1 => 'Phpfox\\Action\\JsonResponse',
    ),
    'response.html' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\HtmlResponse',
    ),
    'response.partial' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Action\\JsonResponse',
    ),
    'assets' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Assets\\AssetsFacades',
      2 => NULL,
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
    'breadcrumb' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Breadcrumb\\Breadcrumb',
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
    'i18n' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\I18n\\I18n',
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
    'mail.log' => 
    array (
      0 => 'Phpfox\\Logger\\LogContainerFactory',
      1 => NULL,
      2 => 'mail.log',
    ),
    'debug.log' => 
    array (
      0 => 'Phpfox\\Logger\\LogContainerFactory',
      1 => NULL,
      2 => 'debug.log',
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
      1 => 'Neutron\\Core\\Service\\MailManager',
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
    'pagination' => 
    array (
      0 => NULL,
      1 => 'Phpfox\\Paging\\Pagination',
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
      1 => 'Neutron\\Core\\Service\\I18nLoader',
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
    'core.i18n' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\I18nManager',
    ),
    'core.packages' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\PackageManager',
    ),
    'core.themes' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\ThemeManager',
    ),
    'core.mails' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\MailManager',
    ),
    'core.roles' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\AclManager',
    ),
    'core.storage' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\StorageManager',
    ),
    'core.setting' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\SettingManager',
    ),
    'core.cache' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\CacheManager',
    ),
    'core.log' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\LogManager',
    ),
    'core.adapter' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\AdapterManager',
    ),
    'layout_loader' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Core\\Service\\LayoutManager',
    ),
    'menu.main.primary' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => 'main',
    ),
    'menu.main.secondary' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => NULL,
    ),
    'menu.main.mini' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => 'main.mini',
    ),
    'menu.admin.primary' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => 'admin',
    ),
    'menu.admin.secondary' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => NULL,
    ),
    'menu.admin.buttons' => 
    array (
      0 => 'Phpfox\\Navigation\\NavigationFactory',
      1 => NULL,
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
    'theme_galaxy.callback' => 
    array (
      0 => NULL,
      1 => 'Neutron\\ThemeGalaxy\\Service\\EventListener',
    ),
    'pages.callback' => 'Neutron\\Pages\\Service\\EventListener',
    'pages.browse' => 'Neutron\\Pages\\Service\\Browse',
    'pages.profile_filter' => 'Neutron\\Pages\\Service\\ProfileNameFilter',
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
      1 => 'Neutron\\Video\\Service\\VideoManager',
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
    'dev.code_generator' => 
    array (
      0 => NULL,
      1 => 'Neutron\\Dev\\Service\\CodeGenerator',
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
    'jquery' => 'package/jquery/jquery',
    'bootstrap' => 'package/bootstrap/bootstrap',
    'jqueryui' => 'package/jquery/jqueryui',
    'underscore' => 'package/underscore/underscore.min',
    'tiny_mce' => 'package/tinymce/jquery.tinymce.min',
    'core' => 'package/core/main',
    'extras' => 'package/core/extras',
  ),
  'static.js' => 
  array (
    'require' => 'package/requirejs/require.js',
  ),
  'static.css' => 
  array (
    'main' => '@css/main.css',
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
    'default:layout-editor/edit-container' => 'package/core/layout-editor/edit-container',
    'default:layout-editor/edit-location' => 'package/core/layout-editor/edit-location',
    'default:core/admin-acl/manage-acl-role' => 'package/core/view/admin-acl/manage-acl-role',
    'default:core/admin-cache/manage-cache-adapter' => 'package/core/view/admin-cache/manage-cache-adapter',
    'default:core/admin-captcha/manage-captcha-adapter' => 'package/core/view/admin-captcha/manage-captcha-adapter',
    'default:core/admin-i18n/manage-i18n-currency' => 'package/core/view/admin-i18n/manage-i18n-currency',
    'default:core/admin-i18n/manage-i18n-locale' => 'package/core/view/admin-i18n/manage-i18n-locale',
    'default:core/admin-i18n/manage-i18n-message' => 'package/core/view/admin-i18n/manage-i18n-message',
    'default:core/admin-i18n/manage-i18n-timezone' => 'package/core/view/admin-i18n/manage-i18n-timezone',
    'default:core/admin-index/coming-soon' => 'package/core/view/admin-index/coming-soon',
    'default:core/admin-index/index' => 'package/core/view/admin-index/index',
    'default:core/admin-layout/clone-page' => 'package/core/view/admin-layout/clone-page',
    'default:core/admin-layout/debug-theme' => 'package/core/view/admin-layout/debug-theme',
    'default:core/admin-layout/design-page' => 'package/core/view/admin-layout/design-page',
    'default:core/admin-layout/manage-layout-component' => 'package/core/view/admin-layout/manage-layout-component',
    'default:core/admin-layout/manage-layout-page' => 'package/core/view/admin-layout/manage-layout-page',
    'default:core/admin-layout/manage-theme' => 'package/core/view/admin-layout/manage-theme',
    'default:core/admin-log/manage-log-adapter' => 'package/core/view/admin-log/manage-log-adapter',
    'default:core/admin-mail/manage-mail-adapter' => 'package/core/view/admin-mail/manage-mail-adapter',
    'default:core/admin-message/manage-message-adapter' => 'package/core/view/admin-message/manage-message-adapter',
    'default:core/admin-package/manage-core-package' => 'package/core/view/admin-package/manage-core-package',
    'default:core/admin-session/manage-session-adapter' => 'package/core/view/admin-session/manage-session-adapter',
    'default:core/admin-settings/index' => 'package/core/view/admin-settings/index',
    'default:core/admin-status/manage-health-check' => 'package/core/view/admin-status/manage-health-check',
    'default:core/admin-status/manage-overview' => 'package/core/view/admin-status/manage-overview',
    'default:core/admin-status/manage-statistics' => 'package/core/view/admin-status/manage-statistics',
    'default:core/admin-storage/manage-storage-adapter' => 'package/core/view/admin-storage/manage-storage-adapter',
    'default:core/admin-verify/manage-verify-adapter' => 'package/core/view/admin-verify/manage-verify-adapter',
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
    'default:grid/edit-simple-011' => 'package/core/layout/grid/edit-simple-011',
    'default:grid/edit-simple-110' => 'package/core/layout/grid/edit-simple-110',
    'default:grid/edit-simple-111' => 'package/core/layout/grid/edit-simple-111',
    'default:grid/edit-simple' => 'package/core/layout/grid/edit-simple',
    'default:grid/simple-011' => 'package/core/layout/grid/simple-011',
    'default:grid/simple-110' => 'package/core/layout/grid/simple-110',
    'default:grid/simple-111' => 'package/core/layout/grid/simple-111',
    'default:grid/simple' => 'package/core/layout/grid/simple',
    'admin:layout/breadcrumb' => 'package/core/layout/admin/breadcrumb',
    'admin:layout/default' => 'package/core/layout/admin/default',
    'admin:layout/form-edit' => 'package/core/layout/admin/form-edit',
    'admin:layout/form-filter' => 'package/core/layout/admin/form-filter',
    'admin:layout/login' => 'package/core/layout/admin/login',
    'admin:layout/pagination-sliding' => 'package/core/layout/admin/pagination-sliding',
    'default:user/admin-user/manage-user' => 'package/user/view/admin-user/manage-user',
    'default:user/auth/login' => 'package/user/view/auth/login',
    'default:user/auth/logout' => 'package/user/view/auth/logout',
    'default:user/profile/index' => 'package/user/view/profile/index',
    'default:user/register/index' => 'package/user/view/register/index',
    'default:user/settings/index' => 'package/user/view/settings/index',
    'default:user/settings/login-history' => 'package/user/view/settings/login-history',
    'default:blog/admin-category/manage-blog-category' => 'package/blog/view/admin-category/manage-blog-category',
    'default:blog/admin-category/menu' => 'package/blog/view/admin-category/menu',
    'default:blog/admin-post/manage-blog-post' => 'package/blog/view/admin-post/manage-blog-post',
    'default:blog/block/category' => 'package/blog/view/block/category',
    'default:blog/index/index' => 'package/blog/view/index/index',
    'default:blog/post/view' => 'package/blog/view/post/view',
    'default:video/index/embed' => 'package/video/view/index/embed',
    'default:video/index/index' => 'package/video/view/index/index',
    'default:video/partial/embed' => 'package/video/view/partial/embed',
    'default:contact/admin/manage-department' => 'package/contact/view/admin/manage-department',
    'default:contact/index/index' => 'package/contact/view/index/index',
    'default:report/admin-category/manage-report-category' => 'package/report/view/admin-category/manage-report-category',
    'default:report/admin-item/manage-report-item' => 'package/report/view/admin-item/manage-report-item',
    'default:dev/admin-dev/manage-dev-action' => 'package/dev/view/admin-dev/manage-dev-action',
    'default:dev/admin-dev/manage-dev-model' => 'package/dev/view/admin-dev/manage-dev-model',
    'default:dev/admin-dev/manage-dev-table' => 'package/dev/view/admin-dev/manage-dev-table',
    'default:dev/template/form-acl-settings-class' => 'package/dev/view/template/form-acl-settings-class',
    'default:dev/template/form-admin-add-class' => 'package/dev/view/template/form-admin-add-class',
    'default:dev/template/form-admin-edit-class' => 'package/dev/view/template/form-admin-edit-class',
    'default:dev/template/form-admin-filter-class' => 'package/dev/view/template/form-admin-filter-class',
    'default:dev/template/form-site-settings-class' => 'package/dev/view/template/form-site-settings-class',
    'default:dev/template/form-test-case-class' => 'package/dev/view/template/form-test-case-class',
    'default:dev/template/model-class' => 'package/dev/view/template/model-class',
    'default:dev/template/model-config' => 'package/dev/view/template/model-config',
    'default:dev/template/model-test-case-class' => 'package/dev/view/template/model-test-case-class',
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
  'core' => 
  array (
    'default_captcha_id' => '3',
    'default_verify_id' => '',
    'license_key' => '',
    'license_email' => '',
    'license_package' => '',
    'session_type' => '5',
    'cookie_path' => '/',
    'cookie_domain' => '',
    'http_only' => '0',
  ),
  'core.default_captcha_id' => '3',
  'core.default_verify_id' => '',
  'core.license_key' => '',
  'core.license_email' => '',
  'core.license_package' => '',
  'core.session_type' => '5',
  'core.cookie_path' => '/',
  'core.cookie_domain' => '',
  'core.http_only' => '0',
);