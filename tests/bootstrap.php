<?php

/**
 * For to development mode.
 */
define('PHPFOX_ENV', 'development');

/**
 * Running PhpUnit
 */
define('PHPFOX_UNIT_TEST', true);

define('PHPFOX_DATABASE_FILE', __DIR__ . '/database.php');

define('PHPFOX_DATA_DIR', __DIR__ . '/data/');

include __DIR__ . '/../config/bootstrap.php';