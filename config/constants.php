<?php

defined('PHPFOX_DIR') or define('PHPFOX_DIR', dirname(__DIR__));

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

defined('PHPFOX_BASE_DIR') or define('PHPFOX_BASE_DIR', '/pf5/');

defined('PHPFOX_BASE_URL') or define('PHPFOX_BASE_URL', '/pf5/');

defined('PHPFOX_LIBRARY_DIR') or define('PHPFOX_LIBRARY_DIR',
    PHPFOX_DIR . DS . 'library');

defined('PHPFOX_PACKAGE_DIR') or define('PHPFOX_PACKAGE_DIR',
    PHPFOX_DIR . DS . 'package');

defined('PHPFOX_TABLE_PREFIX') or define('PHPFOX_TABLE_PREFIX', 'pf5_');

defined('PHPFOX_NO_CACHE') or define('PHPFOX_NO_CACHE', false);

defined('PHPFOX_NO_SESSION') or define('PHPFOX_NO_SESSION', false);