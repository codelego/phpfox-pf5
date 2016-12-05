<?php

/**
 * Options: system dependency
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * string
 * phpfox root directory
 */
defined('PHPFOX_DIR') or define('PHPFOX_DIR', dirname(__DIR__) . DS);

/**
 * string
 * Options: production|development|staging
 */
defined('PHPFOX_ENV') or define('PHPFOX_ENV', 'development');

/**
 * bool
 * Option: true|false
 */
defined('PHPFOX_UNIT_TEST') or define('PHPFOX_UNIT_TEST', false);


/**
 * string
 */
defined('PHPFOX_BASE_DIR') or define('PHPFOX_BASE_DIR', '/pf5/');

/**
 * string
 */
defined('PHPFOX_BASE_URL') or define('PHPFOX_BASE_URL', '/pf5/');

/**
 * string
 */
defined('PHPFOX_LIBRARY_DIR') or define('PHPFOX_LIBRARY_DIR',
    PHPFOX_DIR . 'library' . DS);

/**
 * string
 */
defined('PHPFOX_PACKAGE_DIR') or define('PHPFOX_PACKAGE_DIR',
    PHPFOX_DIR . 'package' . DS);

/**
 * string
 *
 */
defined('PHPFOX_TABLE_PREFIX') or define('PHPFOX_TABLE_PREFIX', 'pf5_');

/**
 * string
 */
defined('PHPFOX_NO_SESSION') or define('PHPFOX_NO_SESSION', false);

/**
 *
 */
defined('PHPFOX_DEFAULT_DB') or define('PHPFOX_DEFAULT_DB', 'db');