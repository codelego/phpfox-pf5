<?php

/**
 * @const PHPFOX_VERSION string
 */
defined('PHPFOX_VERSION') OR define('PHPFOX_VERSION', '4.5.2');

/**
 * @const DS DIRECTORY_SEPARATOR
 */
defined('DS') OR define('DS', DIRECTORY_SEPARATOR);


/**
 * phpfox root directory
 *
 * @const PHPFOX_DIR string
 */
defined('PHPFOX_DIR') OR define('PHPFOX_DIR', dirname(dirname(__DIR__)) . DS);

defined('PHPFOX_APP_DIR') OR define('PHPFOX_APP_DIR', PHPFOX_DIR . 'app' . DS);


/**
 * @const PHPFOX_CONFIG_DIR string
 */
defined('PHPFOX_CONFIG_DIR') OR define('PHPFOX_CONFIG_DIR', PHPFOX_APP_DIR . 'config' . DS);

/**
 * @const PHPFOX_DATABASE_FILE string
 */
defined('PHPFOX_DATABASE_FILE') OR define('PHPFOX_DATABASE_FILE', PHPFOX_CONFIG_DIR . 'database.php');

/**
 * Some menu/action/dropdown show for developer only, not development mode.
 *
 * @const PHPFOX_IS_DEV boolean
 */
defined('PHPFOX_IS_DEV') OR define('PHPFOX_IS_DEV', false);

/**
 * @const PHPFOX_ENV string production|development|staging
 */
defined('PHPFOX_ENV') OR define('PHPFOX_ENV', 'production');

/**
 * @const PHPFOX_UNIT_TEST bool
 */
defined('PHPFOX_UNIT_TEST') OR define('PHPFOX_UNIT_TEST', false);


/**
 * @const PHPFOX_BASE_DIR string
 */
defined('PHPFOX_BASE_DIR') OR define('PHPFOX_BASE_DIR', '/pf5/');

/**
 * @const PHPFOX_BASE_URL string
 */
defined('PHPFOX_BASE_URL') OR define('PHPFOX_BASE_URL', '/pf5/');

/**
 * @const PHPFOX_LIBRARY_DIR string
 */
defined('PHPFOX_LIBRARY_DIR') OR define('PHPFOX_LIBRARY_DIR', PHPFOX_APP_DIR . 'library' . DS);

/**
 * @const PHPFOX_PACKAGE_DIR string
 */
defined('PHPFOX_PACKAGE_DIR') OR define('PHPFOX_PACKAGE_DIR', PHPFOX_APP_DIR . 'package' . DS);

/**
 * @const PHPFOX_STATIC_DIR string
 */
defined('PHPFOX_STATIC_DIR') OR define('PHPFOX_STATIC_DIR', PHPFOX_DIR . 'static' . DS);

/**
 * @const PHPFOX_THEME_DIR string
 */
defined('PHPFOX_THEME_DIR') OR define('PHPFOX_THEME_DIR', PHPFOX_DIR . 'static' . DS . 'themes' . DS);

/**
 * @const PHPFOX_DATA_DIR string
 */
defined('PHPFOX_DATA_DIR') OR define('PHPFOX_VAR_DIR', PHPFOX_APP_DIR . 'var' . DS);

/**
 * Where to save session
 *
 * @const PHPFOX_SESSION_DIR string
 */
defined('PHPFOX_SESSION_DIR') OR define('PHPFOX_SESSION_DIR', PHPFOX_VAR_DIR . 'session' . DS);

/**
 * @const PHPFOX_LOG_DIR string
 */
defined('PHPFOX_LOG_DIR') OR define('PHPFOX_LOG_DIR', PHPFOX_VAR_DIR . 'log' . DS);

/**
 * @const PHPFOX_TEMP_DIR string
 */
defined('PHPFOX_TEMP_DIR') OR define('PHPFOX_TEMP_DIR', PHPFOX_VAR_DIR . 'temp' . DS);

/**
 * @const PHPFOX_CACHE_DIR string
 */
defined('PHPFOX_CACHE_DIR') OR define('PHPFOX_CACHE_DIR', PHPFOX_VAR_DIR . 'cache' . DS);

/**
 * @const PHPFOX_SUPER_DIR string
 */
defined('PHPFOX_SUPER_DIR') OR define('PHPFOX_SUPER_DIR', PHPFOX_VAR_DIR . 'super' . DS);

/**
 * @const PHPFOX_PUBLIC_ID 0
 */
defined('PHPFOX_PUBLIC_ID') OR define('PHPFOX_PUBLIC_ID', 0);

/**
 * @const PHPFOX_REGISTERED_ID 1
 */
defined('PHPFOX_REGISTERED_ID') OR define('PHPFOX_REGISTERED_ID', 1);

/**
 * @const PHPFOX_GUEST_ID 6
 */
defined('PHPFOX_GUEST_ID') OR define('PHPFOX_GUEST_ID', 7);


/**
 * @const PHPFOX_TABLE_PREFIX pf5_
 */
defined('PHPFOX_TABLE_PREFIX') OR define('PHPFOX_TABLE_PREFIX', 'pf5_');

/**
 * @const PHPFOX_DEFAULT_DB db
 */
defined('PHPFOX_DEFAULT_DB') OR define('PHPFOX_DEFAULT_DB', 'db');

/**
 * @const PHPFOX_DESC_LENGTH 255
 */
defined('PHPFOX_DESC_LENGTH') OR define('PHPFOX_DESC_LENGTH', 255);

/**
 * @const PHPFOX_TITLE_LENGTH 50
 */
defined('PHPFOX_TITLE_LENGTH') OR define('PHPFOX_TITLE_LENGTH', 50);

/**
 * @const PHPFOX_DESC_ROWS 5
 */
defined('PHPFOX_DESC_ROWS') OR define('PHPFOX_DESC_ROWS', 5);


if (!defined('PHPFOX_IS_HTTPS')) {
    switch (true) {
        case isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on':
        case isset($_SERVER['SERVER_PORT']) and $_SERVER['SERVER_PORT'] == 443:
        case isset($_SERVER['HTTP_X_FORWARDED_PROTO']) and $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https':
        case isset($_SERVER['HTTP_CF_VISITOR']) and strpos($_SERVER['HTTP_CF_VISITOR'], 'https'):
            define('PHPFOX_IS_HTTPS', true);
            break;
        default:
            define('PHPFOX_IS_HTTPS', false);
    }

}