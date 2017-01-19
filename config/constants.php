<?php

/**
 * @const DS DIRECTORY_SEPARATOR
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * phpfox root directory
 *
 * @const PHPFOX_DIR string
 */
defined('PHPFOX_DIR') or define('PHPFOX_DIR', dirname(__DIR__) . DS);

/**
 * @const PHPFOX_ENV string production|development|staging
 */
defined('PHPFOX_ENV') or define('PHPFOX_ENV', 'development');

/**
 * @const PHPFOX_UNIT_TEST bool
 */
defined('PHPFOX_UNIT_TEST') or define('PHPFOX_UNIT_TEST', false);


/**
 * @const PHPFOX_BASE_DIR string
 */
defined('PHPFOX_BASE_DIR') or define('PHPFOX_BASE_DIR', '/pf5/');

/**
 * @const PHPFOX_BASE_URL string
 */
defined('PHPFOX_BASE_URL') or define('PHPFOX_BASE_URL', '/pf5/');

/**
 * @const PHPFOX_LIBRARY_DIR string
 */
defined('PHPFOX_LIBRARY_DIR') or define('PHPFOX_LIBRARY_DIR',
    PHPFOX_DIR . 'library' . DS);

/**
 * @const PHPFOX_PACKAGE_DIR string
 */
defined('PHPFOX_PACKAGE_DIR') or define('PHPFOX_PACKAGE_DIR',
    PHPFOX_DIR . 'package' . DS);


/**
 * @const PHPFOX_CONFIG_DIR string
 */
defined('PHPFOX_CONFIG_DIR') or define('PHPFOX_CONFIG_DIR',
    PHPFOX_DIR . 'config' . DS);

/**
 * @const PHPFOX_STATIC_DIR string
 */
defined('PHPFOX_STATIC_DIR') or define('PHPFOX_STATIC_DIR',
    PHPFOX_DIR . 'static' . DS);

/**
 * @const PHPFOX_THEME_DIR string
 */
defined('PHPFOX_THEME_DIR') or define('PHPFOX_THEME_DIR',
    PHPFOX_DIR . 'static' . DS . 'themes' . DS);

/**
 * @const PHPFOX_DATA_DIR string
 */
defined('PHPFOX_DATA_DIR') or define('PHPFOX_DATA_DIR',
    PHPFOX_DIR . 'data' . DS);

/**
 * @const PHPFOX_GUEST_ID 6
 */
defined('PHPFOX_GUEST_ID') or define('PHPFOX_GUEST_ID', 7);

/**
 * @const PHPFOX_TABLE_PREFIX pf5_
 */
defined('PHPFOX_TABLE_PREFIX') or define('PHPFOX_TABLE_PREFIX', 'pf5_');

/**
 * @const PHPFOX_DEFAULT_DB db
 */
defined('PHPFOX_DEFAULT_DB') or define('PHPFOX_DEFAULT_DB', 'db');